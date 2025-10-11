@extends('admin_dashboard.master_layout')

@section('title', 'Push Notification')

@section('content')
    <style>
        .search-top{display:none;}
    </style>
    @if (\Session::has('success'))
        <div class="row">
            <div class="col-md-12">
              <div class="alert alert-success">
                  <ul>
                      <li>{!! \Session::get('success') !!}</li>
                  </ul>
              </div>
            </div>
        </div>
    @endif
    <!-- Top sidebar End -->
    <div class="push-noti-main">

        <h2 class="customer-head">Push Notifications</h2>
        <div class="push-not-outer">
            <div class="push-not-left">
                <form action="{{ route('admin.send_push') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <ul class="noti-form">
                        <li>
                            <span title="hello">Notification Title (Optional) </span>
                            <input type="text" class="notification_title" placeholder="Enter Notification Title" name="notification_title" autocomplete="off">
                        </li>
                        <li>
                            <span title="hello">Notification Text </span>
                            <input type="text" class="notification_body" placeholder="Enter Notification Text" name="notification_body" required="required" autocomplete="off">
                        </li>
                        <li>
                            <span title="hello">Notification Image (Optional) </span>
                            <input type="text" placeholder="Enter Link Here" name="img_link" id="notification_img">
                            <div class="upload-img">
                                <img src="{{asset('admin_dashboard/assets/images/upload.png') }}" alt="cover-img" id="file_btn">
                                <input type="file" id="my_file2" style="display: none;" name="notification_img">
                            </div>
                        </li>
                       
                    </ul>
                    <span class="submit-form"> <input type="submit" value="Send">
                
            </span></form></div>
            <div class="push-not-right">
                <h2>Device Preview</h2>
                <p>This preview provides a general idea of how your message will appear on a mobile device.</p>
                <div class="prev-img">
                    <img src="{{asset('admin_dashboard/assets/images/ios.png') }}" alt="no img">
                    
                    <div class="white-box">
                        <div class="white-box-left">
                            <h4 class="title">Notification Title</h4>
                            <span class="body">Notification Text</span>
                        </div>
                        <div class="white-box-right">
                             <img class="not_img" src="{{asset('admin_dashboard/assets/images/upload.png') }}" alt="no img">
                        </div>
                    </div>
                </div>
                <div class="prev-img">
                    <img src="{{asset('admin_dashboard/assets/images/android.png') }}" alt="no img">
                    <div class="white-box">
                        <div class="white-box-left">
                            <h4 class="title" >Notification Title</h4>
                            <span class="body">Notification Text</span>
                        </div>
                        <div class="white-box-right">
                             <img class="not_img" src="{{asset('admin_dashboard/assets/images/upload.png') }}" alt="no img">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(function(){
            $('#file_btn').on('click',function(){
                $("#my_file2").click();
            });
            my_file2.onchange = evt => {
                const [file] = my_file2.files
                if (file) {
                   
                    if (my_file2.files && my_file2.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('.not_img').attr('src', e.target.result);
                            var fileName = e.target.files[0].name;
                            $('#notification_img').val(fileName);
                        }

                        reader.readAsDataURL(my_file2.files[0]);
                    }
                }
            }


            $('#notification_img').on('change',function(e){
                if($(this).val() != ''){
                    $('.not_img').attr('src', $(this).val() );
                }else{
                   $('.not_img').attr('src', '{!! asset("admin_dashboard/assets/images/upload.png") !!}' );
                }
            });
             $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert-success").slideUp(500);
            });
            $(".notification_title").on('keyup',function(){
                if($(this).val() != ''){
            	   $('.title').html($(this).val());
                }else{
                   $('.title').html("Notification Title");
                }
            });
            $(".notification_body").on('keyup',function(){
                if($(this).val() != ''){
                   $('.body').html($(this).val());
                }else{
                   $('.body').html("Notification Text");
                }
            });

        });
    </script>
@endsection