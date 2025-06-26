<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kitchen Display</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    .order-card {
      border-radius: 10px;
      padding: 15px;
      color: #000;
      min-height: 300px;
      margin-bottom: 20px;
    }
    .header-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px;
      background-color: #1d2a35;
      color: white;
      border-radius: 8px;
    }
    .order-meta {
      font-size: 14px;
      margin-bottom: 5px;
    }
    .order-time {
      font-size: 12px;
      opacity: 0.8;
    }
    .badge-time {
      position: absolute;
      top: 15px;
      right: 15px;
      border-radius: 30px;
      padding: 5px 12px;
    }
  </style>
</head>
<body style="background-color: #243848;">

<div class="container mt-4">
  <!-- Header -->
  <div class="header-bar mb-4" style="background-color: #1c1f21;">
    <div >
      <h5 class="mb-0">     @php
                $preference = \App\Models\UserPreference::first();
                $logoPath = $preference && $preference->logo
                    ? asset($preference->logo)
                    : asset('assets/images/OroSMap.png');
            @endphp
            
            <img class="img-fluid rounded-circle nav-fit" id="avatar-Image" src="{{ $logoPath }}" alt="System Logo">
            
            
            <style>
                .nav-fit {
                    width: 50px;
                    height: 50px;
                    object-fit: cover;
                    border-radius: 50%;
                    border: 2px solid #ccc;
                }
            </style> eMenu Express</h5>
      
    </div>
     <div id="status-badges">
            <span class="badge bg-danger me-3">0 New</span>
            <span class="badge bg-warning text-dark me-3">0 Process</span>
            <span class="badge bg-success me-3">0 Ready</span>
            <span class="badge bg-secondary">0 Served</span>
        </div>
  </div>

   <div class="row mt-4" id="orders-container">
    </div>
</div>
    
<script>
let countdownIntervals = {};
let offlineQueue = JSON.parse(localStorage.getItem('offline_queue') || '[]');

function saveQueue() {
    localStorage.setItem('offline_queue', JSON.stringify(offlineQueue));
}

function retryQueuedRequests() {
    if (!navigator.onLine || offlineQueue.length === 0) return;

    const queueCopy = [...offlineQueue];
    offlineQueue = [];

    queueCopy.forEach(action => {
        $.post(action.url, action.data).fail(() => {
            offlineQueue.push(action);
            saveQueue();
        });
    });

    saveQueue();
}

function sendPost(url, data, callback = null) {
    if (navigator.onLine) {
        $.post(url, data, function (response) {
            if (callback) callback(response);
        }).fail(() => {
            offlineQueue.push({ url, data });
            saveQueue();
        });
    } else {
        offlineQueue.push({ url, data });
        saveQueue();
    }
}

function formatTime(seconds) {
    if (seconds <= 0) return '✅';
    const m = Math.floor(seconds / 60);
    const s = seconds % 60;
    return `${m}:${s.toString().padStart(2, '0')}`;
}

function startCountdown(id, endTime) {
    if (countdownIntervals[id]) clearInterval(countdownIntervals[id]);

    countdownIntervals[id] = setInterval(() => {
        const now = Date.now();
        const remaining = Math.floor((endTime - now) / 1000);
        const badge = document.getElementById(`timer-badge-${id}`);

        if (!badge) {
            clearInterval(countdownIntervals[id]);
            delete countdownIntervals[id];
            return;
        }

        if (remaining <= 0) {
            badge.innerHTML = '✅';
            clearInterval(countdownIntervals[id]);
            delete countdownIntervals[id];
            localStorage.setItem(`timer_done_${id}`, '1');
            localStorage.removeItem(`timer_${id}`);
            updateStatus(id, 3);
        } else {
            badge.innerHTML = formatTime(remaining);
        }
    }, 1000);
}

function updateStatus(id, status) {
    if (status >= 3) {
        clearInterval(countdownIntervals[id]);
        delete countdownIntervals[id];
        localStorage.setItem(`timer_done_${id}`, '1');
        localStorage.removeItem(`timer_${id}`);
        const badge = document.getElementById(`timer-badge-${id}`);
        if (badge) badge.innerHTML = '✅';
    } else {
        localStorage.removeItem(`timer_done_${id}`);
    }

    sendPost('/kitchen/update-status', {
        id: id,
        status: status,
        _token: '{{ csrf_token() }}'
    }, fetchOrders);
}

function setTimer(id, timer) {
    const currentStatus = parseInt($(`select[onchange*="updateStatus(${id}"]`).val());
    if (currentStatus >= 3) return;

    const endTime = Date.now() + timer * 60 * 1000;
    localStorage.setItem(`timer_${id}`, endTime);
    localStorage.removeItem(`timer_done_${id}`);

    sendPost('/kitchen/set-timer', {
        id: id,
        timer: timer,
        _token: '{{ csrf_token() }}'
    }, fetchOrders);

    updateStatus(id, 2); 
}

function closeOrder(id) {
    updateStatus(id, 5); 
}

function fetchOrders() {
    $.get('/kitchen/orders', function (orders) {
        const container = $('#orders-container');
        container.empty();

        let servedCount = 0;

        orders.forEach(order => {
            if (order.kitchen_status === 4 || order.kitchen_status === 5) {
                servedCount++;
            }
        });

        orders = orders.filter(order => order.kitchen_status !== 5);

        const counts = { 1: 0, 2: 0, 3: 0, 4: 0 };
        orders.forEach(order => counts[order.kitchen_status]++);

        $('#status-badges').html(`
            <span class="badge bg-danger me-2">${counts[1]} New</span>
            <span class="badge bg-warning text-dark me-2">${counts[2]} Process</span>
            <span class="badge bg-success me-2">${counts[3]} Ready</span>
            <span class="badge bg-secondary">${servedCount} Served</span>
        `);

        orders.sort((a, b) => {
            if (a.kitchen_status === 4 && b.kitchen_status !== 4) return 1;
            if (a.kitchen_status !== 4 && b.kitchen_status === 4) return -1;
            return 0;
        });

        orders.forEach(order => {
            const id = order.items[0].id;
            const status = order.kitchen_status;
            const timerKey = `timer_${id}`;
            const doneKey = `timer_done_${id}`;
            const endTime = parseInt(localStorage.getItem(timerKey)) || null;
            const isDone = localStorage.getItem(doneKey);

            let badgeText;
            if (isDone || status >= 3) {
                badgeText = '✅';
            } else if (endTime && Date.now() >= endTime) {
                badgeText = '✅';
                localStorage.setItem(doneKey, '1');
                localStorage.removeItem(timerKey);
            } else if (endTime) {
                badgeText = formatTime(Math.floor((endTime - Date.now()) / 1000));
            } else {
                badgeText = order.timer ? `${order.timer} mins` : 'No timer';
            }

            const badgeHtml = `<span class="badge bg-light text-dark" id="timer-badge-${id}">${badgeText}</span>`;
            const products = order.items.map(item => `<li>${item.quantity}x ${item.product_name}</li>`).join('');

            const statusSelect = `
                <select class="form-select form-select-sm w-50" onchange="updateStatus(${id}, this.value)">
                    <option value="1" ${status == 1 ? 'selected' : ''}>New</option>
                    <option value="2" ${status == 2 ? 'selected' : ''}>Process</option>
                    <option value="3" ${status == 3 ? 'selected' : ''}>Ready</option>
                    <option value="4" ${status == 4 ? 'selected' : ''}>Served</option>
                </select>`;

            const timerDisabled = (isDone || status >= 3) ? 'disabled' : '';
            const closeBtn = status == 4 ? `<button class="btn btn-sm btn-danger ms-2 text-white" onclick="closeOrder(${id})">X</button>` : '';

            container.append(`
                <div class="col-md-3">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header text-white ${['', 'bg-danger', 'bg-warning text-dark', 'bg-success', 'bg-secondary'][status]} d-flex justify-content-between align-items-center">
                            <div>
                                <strong>📡 Table ${order.table_no}</strong><br>
                                <small>Order #: ${order.order_no}</small>
                            </div>
                            <div class="text-center mt-2 text-white">
                                <h6>${order.order_type == 0 ? 'Dine In' : 'Take Out'}</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                ${badgeHtml}
                                ${closeBtn}
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            
                            <div class="text-muted mb-2" style="font-size: 12px;">${new Date(order.created_at).toLocaleTimeString()}</div>
                            <ul class="mb-3">${products}</ul>
                            <div class="d-flex gap-2">
                                <input type="number" class="form-control form-control-sm" placeholder="Set Timer"
                                    onchange="setTimer(${id}, this.value)" value="${order.timer ?? ''}" ${timerDisabled}>
                                ${statusSelect}
                            </div>
                        </div>
                    </div>
                </div>
            `);

            if (endTime && !isDone && status < 3) {
                startCountdown(id, endTime);
            }
        });
    });
}

fetchOrders();
setInterval(fetchOrders, 5000);
setInterval(retryQueuedRequests, 5000);
</script>

</body>
</html>
