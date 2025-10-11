

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{env("APP_NAME")}}</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    .switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 24px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: -5px;
  bottom: 4px;
  background-color: #FF3D5A;
color: white;
border-color: #FF3D5A;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: white;
  box-shadow: 0 0 5px #FF3D5A;
}

input:focus + .slider {
  box-shadow: 0 0 5px #FF3D5A;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  box-shadow: 0 0 1px #FF3D5A;
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
    .nav-link {
    display: block;
    padding: 0.5rem 1rem;
    color: #FF3D5A;
    font-size: 14px;
    text-decoration: none;
    transition: color .15s ease-in-out,
    background-color .15s ease-in-out,
    border-color .15s ease-in-out;
}
a.nav-link.active {
    /* margin-block-start: 10
px
; */
background: white;
    /* width: fit-content; */
    border-radius: 4px;
    color:  #7E8190;

}
    .position-sticky.pt-2{
        position: absolute;
width: 225px;
height: 777px;
left: 19px;
top: 19px;

background: #7E8190;
border-radius: 12px;
    }
    .nav-item{
        color:white;
        margin: 5px 10px 10px 5px ;
    border-radius: 4px;
    padding: 2px 2px 2px 2px;
    
    float: center;
    }
    .name{
      font-weight: bold;
      color: black;
      display: inline-block;
    }
    .Acctyp{
      color: skyblue;
      display: inline-block;

    }
    .lc{
      font-weight: bold;
      color: black;
      display: inline-block;
    }
    button.btn {
    color: deeppink;
    
}
    .stts{
      font-weight: bold;
      display: inline-block;
      color: greenyellow;
    }
    .Ac{
      font-weight: bold;
      color: black;
      display: inline-block;
    }
    .Cus{
      font-weight: bold;
      color: black;
      display: inline-block;
    }
    #tlp{
      display:inline;
    }
    .nav-item:hover{
  
    background-color: white;
    /* width: fit-content; */
   
    color: rgb(78, 74, 74);
    
    }
    button#profile:active {
    color: white;
    background-color: deeppink;
    border: none;

}

.d-flex.justify-content-between.flex-wrap.flex-md-nowrap.align-items-center.pt-3.pb-2.mb-3.border-bottom {
    background-color: white;
    margin: 15px;
    border-radius: 5px;
    box-shadow: black;
}
.ptext{
  font-size:14px;
}
.pimg{
  border-radius:50%;
  width:150px;
  height:150px;
}
input.form-control.col-sm-2 {
    border-radius: 24px;
    width: 338px;
    border: 1px black solid;
    border-color: #c3bdbd;
    margin: 10px;
}
    button#profile{
        border-top-left-radius: 34px;
    border-bottom-left-radius: 34px;
    color: black;
    width: 107px;
    background-color: white;
    height: 49px;
}
.logo {
    text-align: center;
    border-bottom: 1px black;
    padding: 20px;
    color: White;
    font-weight: initial;
    font-size: 20px;
    margin: 0px 30px 3px 34px;
}
.ttl{
  display: inline-block;
}
button#profile:hover{
color:white;
background-color: deeppink;
border: none;
}
button#Reviews{
    border-top-right-radius: 34px;
    border-bottom-right-radius: 34px;
    color: black;
    background-color: white;
    width: 107px;
    height: 49px;

}

#prow{
  margin-top:58px;
}
.bdy{
  position: absolute;
width: 617px;
height: 397px;
left: 316px;
top: 305px;

border: 1px solid #B0B0B0;
box-sizing: border-box;
}
button#profile:hover{
color:white;
background-color: deeppink;
border: none;
}
label {
   cursor: pointer;
   font-size: smaller;
   /* Style as you please, it will become the visible UI component. */
}
button#pprofile{
        
        color: white;
        width: fit-content;
         
        background-color: blue;
        height: fit-content;
        font-size: 8px;
    }
    button#pprofile:hover{
            
            color: white;
           
            background-color: blue;
            
        }
        button#pprofile:focus{
            
            color: white;
        
            background-color: blue;
         
        }
        button#rReviews{
            color: black;
        width: fit-content;
        background-color: white;
        height: fit-content;
        font-size: 8px;
           
        }
        button#rReviews:hover{
                
                color: white;
            
                background-color: blue;
             
            }
            button#rReviews:focus{
                
                color: white;
               
                background-color: blue;
               
            }
#upload-photo {
   opacity: 0;
   position: absolute;
   z-index: -1;
}
button#Reviews:hover{
    color:white;
background-color: deeppink;
border: none;
}
button#Reviews:focus{
    color:white;
background-color: deeppink;
border: none;
}
button#dropdownMenuButton {
    border: 1px solid #BFCADB;
                    box-sizing: border-box;
                    border-radius: 8px;
                    font-family: Poppins;
font-style: normal;
font-weight: 500;
font-size: 15px;
line-height: 15px;
/* identical to box height, or 100% */

text-align: center;
letter-spacing: -0.5px;

color: #7E7E7E;
background-color: white;
}
button#profile:active {
    color: white;
    background-color: deeppink;
    border: none;
}
button#profile:focus {
    color: white;
    background-color: deeppink;
    user-select: none;
    border: none;
}
.form-outline {
  /* This bit sets up the horizontal layout */
  display:flex;
  flex-direction:row;
  
  /* This bit draws the box around it */
  border:1px solid black;
  width:400px;
  border-radius: 34px;
  /* I've used padding so you can see the edges of the elements. */
  padding:2px;
  margin-left:5px;
}
.lft{
  position: absolute;
width: 662px;
height: 590px;
left: 293px;
top: 206px;
background: #FFFFFF;
box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.07);
}
body{
  background-color: rgb(251, 249, 249);
}
.form-control {
  /* Tell the input to use all the available space */
  flex-grow:2;
  /* And hide the input's outline, so the form looks like the outline */
  border:none;
}
ul.card-text:last-child  {
    font-size: 15px;
    margin: 20px 10px 5px 10px;
    list-style-type:none;
    text-align: left;
}
a.btn.btn-primary {
    
    /* background-position-x: center; */
    margin-top: 58px;
    background-color: white;
    color: #4e4a4a;
    border-color:   rgb(78, 74, 74);;
  
  
}
a.btn.btn-primary:hover {
  
    background-color: deeppink;
    color: white;
    border: deeppink;
    border-radius: 14px;

}
.plogo{
 width:30px;
  height:30px;
 margin:0px 0px 0px 0px;
  box-sizing: content-box;
  border-radius:50%;
}
.card.text-center {
    margin: 20px;
}
.form-control:focus {
  /* removing the input focus blue box. Put this on the form if you like. */
  outline: none;
}

.fltr {
  /* Just a little styling to make it pretty */
  border:1px solid blue;
  background:blue;
  color:white;
}
.btn-primary {
    color: #fff;
    /* background-color: #0d6efd; */
    border-color: #f90dfd;
    color: #f90dfd;
}
.mainstar{
  /* height: max-content;
  width: max-content; */
  border:1px solid white; 
  background-color: white; 
  border-radius: 10px;
  position: relative;
  margin-top: 10px;
    flex: 1 1 auto;
  
    padding: 1rem;
}


@media only screen and (max-width: 767px) {
  .rps {margin:100px 300px 100px 300px;}
  .rfs{width:fit-content;}
  
     .mainstar{
  margin-top: 10px;
      height: max-content;
  width: max-content;
  border:1px solid white; 

  background-color: white; border-radius: 10px;
}
}
@media only screen and (max-width: 967px) {
  .rps {margin:100px 300px 100px 300px;}
  .rfs{width:fit-content;}
  
     .mainstar{
  margin-top: 10px;
      height: max-content;
  width: max-content;
  border:1px solid white; 

  background-color: white; border-radius: 10px;
}
.power{
      max-width:fit-content;
      max-height: fit-content;
     }
    }
</style>
</head>
<body style="background-color: #7E8190; ">


    <section class="ftco-section m-auto p-auto">
<div class="container">
 <div class=" d-flex justify-content-end mt-3">
   <button type="button" class="btn btn-outline-danger d-flex justify-content-end" onclick="window.location.href='Login.html';" style="border:1px white solid; background-color: white;">Log out</button>
                  </div>
                  
<div class="row m-4" style="   
 margin-top: 10px;
    height: max-content;
    width: fit-content;   margin:auto;
    padding:auto;
    border: 1px solid white;
    background-color: white;
    border-radius: 10px;
}"> 
  
  
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="col-lg-4 col-sm-10  col-xs-4 col-md-7 p-4 ">
<ul>
    <li class="row">
        <div class="col-2" style="
        padding:15px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 14px;
        /* identical to box height, or 111% */
        
        letter-spacing: -0.4875px;
        
        color: #939495;"><p style="background-color: #FF3D5A; color:white; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">1</p></div>
        <div class="col-6"><h8 style="font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 13.2px;
            text-align: left;
         
            ">Step One</h8>
            <p style="font-family: Poppins;
            font-style: normal;
            padding: 5px 0px 5px 0px;
            font-weight: 500;
            font-size: 17.6px;
            text-align: left;
            line-height: 11px;
            /* identical to box height, or 61% */
            
            letter-spacing: -0.66px;
            
            color: #FF3D5A;">Contact Info</p>
        </div>
        <div class="col-2"><i class="fa fa-check" style="color:white; padding:2px; margin: 15px; background-color: #15B91F;
            border-radius:50%;"></i></div>
        
    </li>
    <li class="row" s="">
        <div class="col-2" style="
        padding:15px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 14px;
        /* identical to box height, or 111% */
        
        letter-spacing: -0.4875px;
        
        color: black;"><p style="background-color: #FF3D5A; color:white; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">2</p></div>
        <div class="col-6"><h8 style="font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 13.2px;
            text-align: left;
            color: black;
            ">Step Two</h8>
            <p style="font-family: Poppins;
            font-style: normal;
            padding: 5px 0px 5px 0px;
            font-weight: 500;
            font-size: 17.6px;
            text-align: left;
            line-height: 11px;
            /* identical to box height, or 61% */
           
            letter-spacing: -0.66px;
            
           color: #FF3D5A;">Choose Plan </p>
        </div>
        <div class="col-2"><i class="fa fa-check" style="color:white; padding:2px; margin: 15px; background-color: #15B91F;
            border-radius:50%;"></i></div>
        
    </li>
    <li class="row" style="background-color: white; border: 0.88px rgba(128, 128, 128, 0.096) solid;">
        <div class="col-2" style="
        padding:15px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 14px;
        /* identical to box height, or 111% */
        
        letter-spacing: -0.4875px;
        
        color: black;"><p style="background-color: #FF3D5A; color:white; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">3</p></div>
        <div class="col-6"><h8 style="font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 13.2px;
            text-align: left;
            color: black;
            ">Step Three</h8>
            <p style="font-family: Poppins;
            font-style: normal;
            padding: 5px 0px 5px 0px;
            font-weight: 500;
            font-size: 17.6px;
            text-align: left;
            line-height: 11px;
            /* identical to box height, or 61% */
            color: #FF3D5A;
            letter-spacing: -0.66px;
            
            color: #FF3D5A;">Your Business </p>
        </div>
        <!-- <div class="col-2"><i class="fa fa-check" style="color:white; padding:2px; margin: 15px; background-color: #15B91F;
            border-radius:50%;"></i></div>
         -->
    </li>
    <li class="row">
        <div class="col-2" style="
        padding:15px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 14px;
        /* identical to box height, or 111% */
        
        letter-spacing: -0.4875px;
        
        color: #939495;"><p style="background-color: white; color: #939495;; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">4</p></div>
        <div class="col-6"><h8 style="font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 13.2px;
            text-align: left;
            color: #939495;
            ">Step Four</h8>
            <p style="font-family: Poppins;
            font-style: normal;
            padding: 5px 0px 5px 0px;
            font-weight: 500;
            font-size: 13.6px;
            text-align: left;
            line-height: 11px;
            /* identical to box height, or 61% */
            color: #939495;
            letter-spacing: -0.66px;
            
            color: #939495;">Loyalty Scheme </p>
        </div>
        <!-- <div class="col-2"><i class="fa fa-check" style="color:white; padding:2px; margin: 15px; background-color: #15B91F;
            border-radius:50%;"></i></div>
         -->
    </li>
    <li class="row">
        <div class="col-2" style="
        padding:15px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 14px;
        /* identical to box height, or 111% */
        
        letter-spacing: -0.4875px;
        
        color: #939495;"><p style="background-color: white; color: #939495;; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">5</p></div>
        <div class="col-6"><h8 style="font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 13.2px;
            text-align: left;
            color: #939495;
            ">Step Five</h8>
            <p style="font-family: Poppins;
            font-style: normal;
            padding: 5px 0px 5px 0px;
            font-weight: 500;
            font-size: 13.6px;
            text-align: left;
            line-height: 11px;
            /* identical to box height, or 61% */
            color: #939495;
            letter-spacing: -0.66px;
            
            color: #939495;">Complete Set Up</p>
        </div>
        <!-- <div class="col-2"><i class="fa fa-check" style="color:white; padding:2px; margin: 15px; background-color: #15B91F;
            border-radius:50%;"></i></div>
         -->
    </li>
</ul>

</div>
<div class="col-lg-7 col-xs-9 col-md-11 col-sm-9 p-4 m-3">
<div class="justify-content-left" style="width: 60%;
 ">
    <h4 style="margin:20px;">Your Bussiness</h4>
   
   
    <div class="row justify-content-left" style="margin: 0px;">
   <p style="font-family: Poppins;
   font-style: normal;
   font-weight: normal;
   font-size: 14px;">
   <b>Location</b>  (where will stamps be collected by customers?):
  </p>
  <div>
    <!-- <input type="checkbox" id="subscribeNews" name="subscribe" value="newsletter">
    <label for="subscribeNews">Same as registered business address</label> -->
  </div>
      </div>
      <div class="row justify-content-left" style="margin-top: 10px;">
        <table class="table" style="font-size: 10px; color:black; ">
                   <form method="POST" action="{{route('business.detail2')}}">
                     @csrf
            <tbody id="tbody">
              <div id="1">
            <tr id="r1">
              <td>
              <input type="text" id="search1" data-location="1" name="search1" icon="fa fa-location" placeholder=" Search other address" style="background: #FCFCFD;
  border: 1px solid #EAECED;
  box-sizing: border-box;
  width: 150px;
  color: #838383;
height: 50px;
  border-radius: 5px;">



<input type="hidden" name="c1" value="yes">
<input type="hidden" value="lah" name="address1" id="address1">
<input type="hidden" value="lah" name="city1" id="addcity1ress1">
<input type="hidden" value="lah" name="country1" id="country1">
<input type="hidden" value="lah" name="lat1" id="lat1">
<input type="hidden" value="lah" name="lon1" id="lon1">

</td>
                <td> <div class="btn-group p-2" style="margin: 4px;">

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="days1[]" id="days11" value="SUN">
                  <label class="form-check-label" for="days11">SUN</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="days1[]" id="days12" value="MON">
                  <label class="form-check-label" for="days12">MON</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="days1[]" id="days13" value="TUE">
                  <label class="form-check-label" for="days13">TUE</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" nname="days1[]" id="days14" value="WED">
                  <label class="form-check-label" for="days14">WED</label>
                </div>
                <br>
                <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="days1[]"  id="days15" value="THU">
                  <label class="form-check-label" for="days15">THU</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="days1[]" id="days16" value="FRIDAY">
                  <label class="form-check-label" for="days16">FRI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="days1[]" id="days17" value="SAT">
                  <label class="form-check-label" for="days17">SAT</label>
                </div>
                

                   
                  </div>
                </td>

</tr>
<tr id="r1">
                <td><div class="dropdown" style="color: white;">
                
                   <input type="time" class="form-control" name="open_time1">
                    </div>
                  </div></td>
               
                <td><div class="dropdown" style="color: white;">
                <input type="time" class="form-control" name="close_time1">

               
                    </div>
                  </div></td>
              </tr>

</div>


<!-- div2 -->


<div id="2" >
            <tr  class="r2" id="r2">
              <td>
              <input type="text" id="search1" class="dis2" data-location="1" name="search2" icon="fa fa-location" 
              placeholder=" Search other address" style="background: #FCFCFD;
  border: 1px solid #EAECED;
  box-sizing: border-box;
  width: 150px;
  color: #838383;
height: 50px;
  border-radius: 5px;">



<input type="hidden" class="dis2" name="c2" value="yes">
<input type="hidden" value="lah" class="dis2" name="address2" id="address2">
<input type="hidden" value="lah" class="dis2" name="city2" id="city2">
<input type="hidden" value="lah" name="country2" class="dis2" id="country2">
<input type="hidden" value="lah" name="lat2" id="lat2" class="dis2">
<input type="hidden" value="lah" name="lon2" id="lon2" class="dis2">

</td>
                <td> <div class="btn-group p-2" style="margin: 4px;">

                <div class="form-check form-check-inline">
                  <input class="form-check-input dis2" type="checkbox" name="days2[]" id="days21" value="SUN">
                  <label class="form-check-label dis2" for="days21">SUN</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis2" type="checkbox" name="days2[]" id="days22" value="MON">
                  <label class="form-check-label dis2" for="days22">MON</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis2" type="checkbox" name="days2[]" id="days23" value="TUE">
                  <label class="form-check-label" for="days23">TUE</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis2" type="checkbox" nname="days2[]" id="days24" value="WED">
                  <label class="form-check-label" for="days24">WED</label>
                </div>
                <br>
                <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis2" type="checkbox" name="days2[]"  id="days25" value="THU">
                  <label class="form-check-label" for="days25">THU</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis2 " type="checkbox" name="days2[]" id="days26" value="FRIDAY">
                  <label class="form-check-label" for="days26">FRI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis2" type="checkbox" name="days2[]" id="days27" value="SAT">
                  <label class="form-check-label" for="days27">SAT</label>
                </div>
                

                   
                  </div>
                </td>

</tr>
<tr class="r2" id="r2">
                <td><div class="dropdown" style="color: white;">
                
                   <input type="time" class="form-control dis2" name="open_time2">
                    </div>
                  </div></td>
               
                <td><div class="dropdown" style="color: white;">
                <input type="time" class="form-control dis2" name="close_time2">

               
                    </div>
                  </div></td>
              </tr>

</div>

<!-- end div2 -->


<!-- div3 -->
<div id="3" hidden >
            <tr class="r3" id="r3">
              <td>
              <input type="text" id="search1" class="dis3" data-location="1" name="search3" icon="fa fa-location" placeholder=" Search other address" style="background: #FCFCFD;
  border: 1px solid #EAECED;
  box-sizing: border-box;
  width: 150px;
  color: #838383;
height: 50px;
  border-radius: 5px;">


<input type="hidden" class="dis3" name="c3" value="yes">

<input type="hidden"  class="dis3" name="address3" id="address3">
<input type="hidden" value="lah" name="city3"  class="dis3" id="city3">
<input type="hidden" value="lah" name="country3" class="dis3" id="country3">
<input type="hidden"value="lah"  name="lat3" class="dis3" id="lat3">
<input type="hidden"value="lah" name="lon3" class="dis3" id="lon3">

</td>
                <td> <div class="btn-group p-2" style="margin: 4px;">

                <div class="form-check form-check-inline">
                  <input class="form-check-input dis3" type="checkbox" name="days3[]" id="days31" value="SUN">
                  <label class="form-check-label" for="days31">SUN</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis3" type="checkbox" name="days3[]" id="days32" value="MON">
                  <label class="form-check-label" for="days32">MON</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis3" type="checkbox" name="days3[]" id="days33" value="TUE">
                  <label class="form-check-label" for="days33">TUE</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis3" type="checkbox" nname="days3[]" id="days34" value="WED">
                  <label class="form-check-label" for="days34">WED</label>
                </div>
                <br>
                <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis3" type="checkbox" name="days3[]"  id="days35" value="THU">
                  <label class="form-check-label" for="days35">THU</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="days3[]" id="days36" value="FRIDAY">
                  <label class="form-check-label" for="days36">FRI</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input dis3" type="checkbox" name="days3[]" id="days37" value="SAT">
                  <label class="form-check-label" for="days37">SAT</label>
                </div>
                

                   
                  </div>
                </td>

</tr>
<tr class="r3" id="r3">
                <td><div class="dropdown" style="color: white; border: 1px solid grey; border-radius:6px">
                START
                   <input type="time" class="form-control dis3" name="open_time3"placeholder="Start time">
                   
                    </div>
                  </div></td>
               
                <td><div class="dropdown" style="color: white; border: 1px solid grey; border-radius:6px">
                
                
<div class="input-group mb-3">
<input type="time" class="form-control dis3" name="close_time3" placeholder="End time">
<span class="input-group-text" id="basic-addon2"style="background-color: white; border: none;"><i class='fa fa-clock '></i></span>
        
</div>

               
                    </div>
                  </div></td>
              </tr>

</div>

<!-- edn div 3 -->
            </tbody>

          </table>
    </div>
    <button   data-id=2 type="button"
     class="btn btn-outline-danger" id="show_more" style=" color:white; border : 0.88px rgba(128, 128, 128, 0.5) solid;margin: 0px 0px 0px 0px ;  font-size: 12px; background: linear-gradient(0deg, #FF3D5A, #FF3D5A);
    box-shadow: 0px 2px 19px 2px rgba(59, 23, 165, 0.308239);
    border-radius: 6px;">Add more</button>

    <div class="row justify-content-center" style="margin-top: 30px;">
    
    <button  type="submit"
 href='YourBusiness2.html'
     class="btn btn-outline-danger" style=" color:white; border : 0.88px rgba(128, 128, 128, 0.5) solid; width:420px; height: 40px; margin: 0px 0px 0px 0px ;  font-size: 12px; background: linear-gradient(0deg, #FF3D5A, #FF3D5A);
    box-shadow: 0px 2px 19px 2px rgba(59, 23, 165, 0.308239);
    border-radius: 6px;">Next --&gt; </button>
  </div>

  </form>
       </div>
</div>
  
</div>

</section>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
$(".dis2, .dis3").attr("disabled",true);
$("#r2 , #r3").css("display","none");


$("#show_more").click(function(){
id=$(this).data("id");
if (id==2  || id==3){

$(".dis"+id).attr("disabled",false);
$(".r"+id).css("display","");

if(id==3){

  $("#show_more").remove();
}
}

$(this).data("id",id+1);

console.log($(this).data("id"));
});


  </script>
</body>
</html>

