@extends('layouts.app')
@section('content')
 {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
 @php
 $themeColor = Auth::user()->preference->system_color ?? '#4CAF50';
 $hex = str_replace('#', '', $themeColor);
 $r = hexdec(substr($hex, 0, 2));
 $g = hexdec(substr($hex, 2, 2));
 $b = hexdec(substr($hex, 4, 2));

 $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b);
 $textColor = $luminance > 186 ? '#000000' : '#FFFFFF'; 
@endphp

<style>
 .list-group-item.active {
     background-color: {{ $themeColor }};
     color: {{ $textColor }};
     border-color: {{ $themeColor }};
 }

 .section {
     padding: 60px 20px;
 }
</style>


<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="container-fluid mt-4">
            <div class="row">
                <!-- Sidebar Menu -->
                <div class="col-md-4">
                    <div class="list-group" id="configMenu">
                        {{-- <a href="#" class="list-group-item list-group-item-action active" data-target="#generalSettings">General Settings</a> --}}
                        <a href="#" class="list-group-item list-group-item-action" data-target="#systemAppearance">System Appearance</a>
                        {{-- <a href="#" class="list-group-item list-group-item-action" data-target="#backupRestore">Back up and Restore</a> --}}
                    </div>
                </div>
               
                <!-- Content Area -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body tab-content">
                            <div id="generalSettings" class="tab-pane fade show active">
                                <h5>General Settings</h5>
                            
                                <button class="btn btn-success float-right">Save Changes</button>
                            </div>
                            
                            <div id="systemAppearance" class="tab-pane fade">
                                {{-- <h5>System Appearance</h5> --}}
                                <form action="{{ route('appearance/update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                
                                    <div class="form-group">
                                        <label for="logo" class="d-block mb-2">Upload New Logo</label>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 mr-5">
                                                <input type="file" name="logo" id="logo" class="form-control">
                                            </div>
                                            @if(Auth::user()->preference && Auth::user()->preference->logo)
                                                @php
                                                    $userPreferences = Auth::user()->preference;
                                                    $logoPath = $userPreferences && $userPreferences->logo
                                                        ? asset($userPreferences->logo)
                                                        : asset('assets/images/OroSMap.png');
                                                @endphp
                                                <hr>
                                                <div>
                                                    <label for=""> Current Logo</label>
                                                    <img class="img-fluid logo-fit ml-5" id="avatarImage" src="{{ $logoPath }}" alt="Current Logo">
                                                </div>
                                            @endif
                                        </div>
                                    
                                        <style>
                                            .logo-fit {
                                                width: 100px;
                                                height: 100px;
                                                object-fit: cover;
                                                border: 2px solid #ccc;
                                            }
                                    
                                            @media (max-width: 576px) {
                                                .d-flex {
                                                    flex-direction: column;
                                                    align-items: flex-start;
                                                }
                                    
                                                .me-3 {
                                                    margin-right: 0 !important;
                                                    margin-bottom: 1rem;
                                                }
                                            }
                                        </style>
                                    </div>
                                    
                                <hr>
                                    <div class="form-group position-relative">
                                        <label for="system_color">System Color</label>
                                        <div class="d-flex flex-wrap gap-2" id="colorOptions">
                                            @php
                                                $presetColors = [
                                                    '#4CAF50', '#2196F3', '#FF5722', '#9C27B0',
                                                    '#FFC107', '#00BCD4', '#E91E63', '#607D8B',
                                                    '#8BC34A', '#3F51B5', '#F44336', '#795548'
                                                ];
                                                
                                                $currentColor = Auth::user()->preference->system_color ?? '#ffffff';
                                            @endphp
                                    
                                            @foreach($presetColors as $color)
                                                <div class="color-circle" data-color="{{ $color }}" 
                                                     style="background: {{ $color }}; border: {{ $currentColor === $color ? '3px solid black' : '1px solid #ccc' }}">
                                                </div>
                                            @endforeach
                                    
                                            <div class="color-circle" id="customColorTrigger" title="Custom Color">
                                                <span style="font-size: 22px; color: #333; font-weight: bold;">+</span>
                                            </div>
                                        </div>
                                    
                                        <input type="hidden" name="system_color" id="system_color" value="{{ $currentColor }}">
                                    
                                        <input type="color" id="colorPicker" style="position: absolute; display: none;">
                                    </div>
                                    
                                    <style>
                                        .color-circle {
                                            width: 40px;
                                            height: 40px;
                                            border-radius: 50%;
                                            cursor: pointer;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            transition: border 0.2s ease;
                                        }
                                    
                                        .color-circle:hover {
                                            opacity: 0.85;
                                        }
                                    
                                        .gap-2 > * {
                                            margin-right: 10px;
                                            margin-bottom: 10px;
                                        }
                                    
                                        .form-group.position-relative {
                                            position: relative;
                                        }
                                    </style>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const colorCircles = document.querySelectorAll('.color-circle');
                                const colorInput = document.getElementById('system_color');
                                const colorPicker = document.getElementById('colorPicker');
                                const customTrigger = document.getElementById('customColorTrigger');

                                colorCircles.forEach(circle => {
                                    circle.addEventListener('click', function () {
                                        if (this.id === 'customColorTrigger') {
                                            const parentRect = this.closest('.form-group').getBoundingClientRect();
                                            const triggerRect = this.getBoundingClientRect();
                                            const topOffset = triggerRect.top - parentRect.top + triggerRect.height + 5;
                                            const leftOffset = triggerRect.left - parentRect.left;

                                            colorPicker.style.top = `${topOffset}px`;
                                            colorPicker.style.left = `${leftOffset}px`;
                                            colorPicker.style.display = 'block';
                                            colorPicker.focus();
                                            // NOTE: REMOVE this line to prevent auto-close behavior
                                            // colorPicker.click();
                                            return;
                                        }

                                        const selectedColor = this.getAttribute('data-color');
                                        colorInput.value = selectedColor;
                                        colorCircles.forEach(c => c.style.border = '1px solid #ccc');
                                        this.style.border = '3px solid black';
                                        colorPicker.style.display = 'none';
                                    });
                                });

                                // Use change instead of input to finalize selection
                                colorPicker.addEventListener('change', function () {
                                    colorInput.value = this.value;
                                    colorCircles.forEach(c => c.style.border = '1px solid #ccc');
                                    colorPicker.style.display = 'none';
                                });
                            });
                            </script>

                                    <hr>
                                
                                    <button type="submit" class="btn btn-success float-right">Save Changes</button>
                                </form>
                            </div>
                            
                           <div id="backupRestore" class="tab-pane fade">
                                <h5>Back up and Restore</h5>

                                <!-- Input & Button -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fa fa-folder"></i>
                                    </span>
                                    <input type="text" id="folderName" class="form-control" placeholder="Enter folder name">
                                    <button class="btn btn-success" onclick="addFolder()">Add Folder</button>
                                </div>

                                <!-- Folder List -->
                                <ul id="folderList" class="list-group mt-3">
                                </ul>
                            </div>

                            <script>
                                function addFolder() {
                                    const folderName = document.getElementById('folderName').value.trim();
                                    const folderList = document.getElementById('folderList');

                                    if (folderName === '') {
                                        alert('Please enter a folder name.');
                                        return;
                                    }
                                    const li = document.createElement('li');
                                    li.className = 'list-group-item';
                                    li.innerHTML = `<i class="fa fa-folder text-warning me-2"></i> ${folderName}`;
                                    
                                    folderList.appendChild(li);

                                    document.getElementById('folderName').value = '';
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('#configMenu a').on('click', function (e) {
                    e.preventDefault();
        
                    const targetTab = $(this).data('target');
                    localStorage.setItem('activeTab', targetTab);
        
                    $('#configMenu a').removeClass('active');
                    $(this).addClass('active');
        
                    $('.tab-pane').removeClass('show active');
                    $(targetTab).addClass('show active');
                });
        
                const lastTab = localStorage.getItem('activeTab');
                if (lastTab) {
                    $('#configMenu a').removeClass('active');
                    $('#configMenu a[data-target="' + lastTab + '"]').addClass('active');
        
                    $('.tab-pane').removeClass('show active');
                    $(lastTab).addClass('show active');
                }
            });
        </script>
        
         
        
    </div>
   
    
@endsection