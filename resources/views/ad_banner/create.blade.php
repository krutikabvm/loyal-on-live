@extends('admin_dashboard.master_layout')

@section('title', 'Dashboard')

@section('content')
<style>
     .business-search{display: block;}
     .customer-search{display: none;}

    .quantity {
        display: flex;
        justify-content: space-between;
        border: 2px solid lightgray;
        border-radius: 4px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom:8px;

    }

    
    .white-box{
        top: 87px;
        left: 0px;
        width:auto;
        background:none;
    }
    .not_img{

        width: 318px;
    height: 169px;

    }
    .prev-img{
        max-width:340px;
    }

    .remove{
        background-color:#ff999a!important;
        color:#690002!important;
    }

    .upload-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 250px;
    }

    .upload-box {
        width: 100%;
        height: 200px;
        border: 2px dashed #ccc;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: #f9f9f9;
    }

    .upload-icon img {
        width: 100px;
        height: 100px;
    }

    .upload-text {
        font-size: 14px;
        color: #777;
        margin-top: 8px;
    }

    .upload-button {
        margin-top: 10px;
        color: #007bff;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .upload-button span {
        margin-left: 5px;
    }
</style>

<section>

    <div class="switch-field">

        <a href="{{route('admin.business')}}" class="back-btn" style="width:100%">Ad-banner</a>

    </div>
    <div class="container">

        <div id="" class=" current">
            <div class="row" style="justify-content: space-between">
                <form action="{{ route('ads_banner.store')}}" method="POST" id="limited_perks_form" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <ul class="noti-form">

                        <li>
                            <!-- <input type="text" placeholder="Enter Link Here" name="img_link" id="notification_img"> -->
                            <div class="upload-img">
                                <input type="file" id="my_file2" style="display: none;" name="notification_img">
                            </div>
                        </li>
                        </ul>

                        <div class="upload-container" id="file_btn">
                            <div class="upload-box">
                                <div class="upload-icon hidden">
                                    <img src="{{asset('admin_dashboard/assets/images/upload.png') }}" alt="cover-img" class="file_btn">
                                </div>
                                <p class="upload-text">Upload Advert image</p>
                                <label class="upload-button">
                                    <span>⬆ Upload an image</span>
                                </label>
                            </div>
                        </div>


                        <div class="account-type-main ">

                            <label class="font-bold" style="margin-bottom:8px;    font-size: large;">Advert Name</label>
                            <div style="margin-bottom:8px;">
                                <input type="text" name="advert_name" class="form-control">
                            </div>
                            <div class="wrapper">
                                <label class="pb-4" style="margin-bottom:8px;    font-size: large;">Url</label>
                                    <input type="text" name="url" class="form-control" style="width:100%">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" style="float-right">Next >> </button>
                    </div>
                </form>

                <div class="col-md-6" style="flex-direction:column;align-items:flex-end">
                <div class="prev-img">
                    <img src="{{asset('admin_dashboard/assets/images/Home.png') }}" alt="no img" style="width:94%;height:80%">

                    <div class="white-box hidden">
                        <img class="not_img" src="{{asset('admin_dashboard/assets/images/upload.png') }}" alt="no img">
                    </div>
                </div>


                </div>
            </div>
        </div>

    </div>
</section>
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
                            $('.white-box').removeClass('hidden');

                            $('.upload-icon').removeClass('hidden');

                            $('.not_img').attr('src', e.target.result);
                            $('.file_btn').attr('src', e.target.result);

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

        });
</script>

@endsection
