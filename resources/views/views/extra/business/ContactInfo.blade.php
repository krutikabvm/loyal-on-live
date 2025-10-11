

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{{env("APP_NAME")}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    .nav-link {
    display: block;
    padding: 0.5rem 1rem;
    color: #FFFFFF;
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
/* Extra small devices (phones, 600px and down) */


/* Small devices (portrait tablets and large phones, 600px and up) */


/* Medium devices (landscape tablets, 768px and up) */
 

/* Large devices (laptops/desktops, 992px and up) */


/* Extra large devices (large laptops and desktops, 1200px and up) */

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
button#Reviews:hover{
    color:white;
background-color: deeppink;
border: none;
}
.power{
  margin-top:20px;
}
button#Reviews:focus{
    color:white;
background-color: deeppink;
border: none;
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
  height: max-content;
  width: max-content;
  border:1px solid white; 
  background-color: white; 
  border-radius: 10px;
  position: relative;
  margin-top: 10px;
    flex: 1 1 auto;
  
    padding: 1rem;
}



</style>
</head>
<html>
<body style="background-color: #7E8190; " data-new-gr-c-s-check-loaded="14.1042.0" data-gr-ext-installed="">

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
<div class="col-lg-4 col-sm-6  col-xs-4 col-md-4 p-4 ">
<ul class="t" style="
          

           
           background-color: #FBFBFC;">

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
        
        color: #939495;"><p style="background-color: white; color: #939495;; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">2</p></div>
        <div class="col-6"><h8 style="font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 13.2px;
            text-align: left;
            color: #939495;
            ">Step Two</h8>
            <p style="font-family: Poppins;
            font-style: normal;
            padding: 5px 0px 5px 0px;
            font-weight: 500;
            font-size: 17.6px;
            text-align: left;
            line-height: 11px;
            /* identical to box height, or 61% */
            color: #939495;
            letter-spacing: -0.66px;
            
            color: #939495;">Choose Plan </p>
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
        
        color: #939495;"><p style="background-color: white; color: #939495;; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">3</p></div>
        <div class="col-6"><h8 style="font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 13.2px;
            text-align: left;
            color: #939495;
            ">Step Three</h8>
            <p style="font-family: Poppins;
            font-style: normal;
            padding: 5px 0px 5px 0px;
            font-weight: 500;
            font-size: 17.6px;
            text-align: left;
            line-height: 11px;
            /* identical to box height, or 61% */
            color: #939495;
            letter-spacing: -0.66px;
            
            color: #939495;">Your Business </p>
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
<div class="col-lg-7 col-xs-9 col-md-6 col-sm-9 p-4 m-3">

<ul class="justify-content-end" style="">
  <form method="POST" action="{{route('business.contactinfo')}}">
    @csrf
  <input name="user_id" value="{{auth()->user()->id}}" type="hidden">
    <li style="list-style-type: none;"> <h4 >Contact Info</h4></li>
        <li class="row">
           <div class="col-4" style="/* margin-left: 5px; */">
               <p style="font-family: Poppins;
               font-style: normal;
               font-weight: bold;
               font-size: 14px;
               line-height: 14px;
               /* identical to box height, or 100% */
               
               letter-spacing: -0.6px;
               
               color: #000000;
               ">Business Name</p>
            <input type="text" name="business_name" style=" border : 0.88px rgba(128, 128, 128, 0.5) solid; width:200px; margin: 0px 0px 0px 0px ; padding: 5px; font-size: 12px; color: #15B91F;" class="form-control" placeholder="Enter Here" aria-label="" aria-describedby="basic-addon1">
   
           </div>
           <div class="col-4" style="margin-left: 81px;">
            <p style="font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 14px;
            line-height: 14px;
            /* identical to box height, or 100% */
            
            letter-spacing: -0.6px;
            
            color: #000000;
            ">Your Name</p>
         <input type="text" disabled value="{{auth()->user()->name}}"style=" border : 0.88px rgba(128, 128, 128, 0.5) solid; width:200px; margin: 0px 0px 0px 0px ; padding: 5px; font-size: 12px; color: #15B91F;" class="form-control" placeholder="Enter Here" aria-label="" aria-describedby="basic-addon1">

        </div>
           <div class="col-4"></div>
        </li>
        <li class="row" style="margin-top: 40px;">
            <div class="col-4">
                <p style="font-family: Poppins;
                font-style: normal;
                font-weight: bold;
                font-size: 14px;
                line-height: 14px;
                /* identical to box height, or 100% */
                
                letter-spacing: -0.6px;
                
                color: #000000;
                ">Business Email</p>
             <input type="email" name="business_email" style=" border : 0.88px rgba(128, 128, 128, 0.5) solid; width:200px; margin: 0px 0px 0px 0px ; padding: 5px; font-size: 12px; color: #15B91F;" class="form-control" placeholder="Enter Here" aria-label="" aria-describedby="basic-addon1">
    
            </div>
            <div class="col-4" style="margin-left: 80px;">
             <p style="font-family: Poppins;
             font-style: normal;
             font-weight: bold;
             font-size: 14px;
             line-height: 14px;
             /* identical to box height, or 100% */
             
             letter-spacing: -0.6px;
             
             color: #000000;
             ">Contact Number</p>
         <input type="text" name="business_number"style=" border : 0.88px rgba(128, 128, 128, 0.5) solid; width:200px; margin: 0px 0px 0px 0px ; padding: 5px; font-size: 12px; color: #15B91F;" class="form-control" placeholder="Enter Here" aria-label="" aria-describedby="basic-addon1">

         </div>
            <div class="col-4"></div>
         </li>

         <li class="row" style="margin-top: 40px;">
       
            <div class="col-6">
          
        <button type="submit" class="btn btn-outline-danger" style=" color:white; border : 0.88px rgba(128, 128, 128, 0.5) solid; width:420px; height: 40px; margin: 0px 0px 0px 0px ;  font-size: 12px; background: linear-gradient(0deg, #FF3D5A, #FF3D5A);
        box-shadow: 0px 2px 19px 2px rgba(59, 23, 165, 0.308239);
        border-radius: 6px;">Save and Contiune </button>
         </div>
           
         </li>
    </ul>
</from>
</div>
</div>
  
</div>

</section>
  



></body>
</html>

