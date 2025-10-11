

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
.dropbtn {
  background-color: white;
  color: black;
  padding: 2px;
  border: 1px rgba(128, 128, 128, 0.561) solid;
  font-size: 14px;
  border: none;
  cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: block;
  float: right;
  width: 100px;
height: 38px;
text-align: center;
  border: 1px solid #DADADA;
box-sizing: border-box;
border-radius: 6px;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 50px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 5px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: white;
  color: black;
}
.btn-primary {
    color: #fff;
    /* background-color: #0d6efd; */
    border-color: #f90dfd;
    color: #f90dfd;
}
.upper-box{
    width: 427px;
    height:100px;
    font-family: Roboto;
font-style: normal;
font-weight: 500;
font-size: 16px;
line-height: 21px;
/* identical to box height, or 128% */


color: #1A1A1A;

}
.bottom-box{
    text-align: center;
width: 407px;
height: 161.23px;
padding:40px 5px 25px 5px;
background: url(/home/brownmunda/Desktop/AdminPanel/123.jpeg);
border-radius: 0px 0px 10px 10px;
}
.inner-box{
   
width: 429px;
height: 222px;


background: #FFFFFF;
border: 1.14px solid #808393;
box-sizing: border-box;
border-radius: 10px;
}
.lbl2{
    height: 120px;

top: calc(50% - 250px/2 - 134px);

font-family: Poppins;
font-style: normal;
font-weight: 500;
font-size: 14px;
line-height: 20px;
/* or 143% */

letter-spacing: -0.6px;

color: #4A4E66;
overflow-y:scroll;
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
<body style="background-color: #7E8190; ">

<section class="ftco-section m-auto p-auto">
<div class="container" >
 <div class=" d-flex justify-content-end mt-3">
   <button type="button" class="btn btn-outline-danger d-flex justify-content-end" onclick="window.location.href='Login.html';"
                    style="border:1px white solid; background-color: white;"
                    >Log out</button>
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
  
<div class="col-lg-4 col-sm-6  col-xs-4 col-md-4 p-4 ">
<ul>
    <li class="row" >
        <div class="col-2" style="
        padding:15px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 14px;
        /* identical to box height, or 111% */
        
        letter-spacing: -0.4875px;
        
        color: #939495;" ><p style="background-color: #FF3D5A; color:white; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">1</p></div>
        <div class="col-6" ><h8 style="font-family: Poppins;
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
    <li class="row" s>
        <div class="col-2" style="
        padding:15px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 14px;
        /* identical to box height, or 111% */
        
        letter-spacing: -0.4875px;
        
        color: black;" ><p style="background-color: #FF3D5A; color:white; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">2</p></div>
        <div class="col-6" ><h8 style="font-family: Poppins;
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
    <li class="row" >
        <div class="col-2" style="
        padding:15px;
        font-family: Poppins;
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 14px;
        /* identical to box height, or 111% */
        
        letter-spacing: -0.4875px;
        
        color: black;" ><p style="background-color: #FF3D5A; color:white; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">3</p></div>
        <div class="col-6" ><h8 style="font-family: Poppins;
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
        
        color: #939495;" ><p style="background-color: #FF3D5A; color:white; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">4</p></div>
        <div class="col-6" ><h8 style="font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 13.2px;
            text-align: left;
            color: black;
            ">Step Four</h8>
            <p style="font-family: Poppins;
            font-style: normal;
            padding: 5px 0px 5px 0px;
            font-weight: 500;
            font-size: 13.6px;
            text-align: left;
            line-height: 11px;
            /* identical to box height, or 61% */
            color: #FF3D5A;
            letter-spacing: -0.66px;
            
            color: #FF3D5A;">Loyalty Scheme </p>
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
        
        color: #FF3D5A;" ><p style="background-color: #FF3D5A; color:white; border-radius: 50%; height: 15px; width: 15px; text-align: center; font-size: 10px; font-weight: bold;">5</p></div>
        <div class="col-6" ><h8 style="font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 13.2px;
            text-align: left;
            color: black;
            ">Step Five</h8>
            <p style="font-family: Poppins;
            font-style: normal;
            padding: 5px 0px 5px 0px;
            font-weight: 500;
            font-size: 13.6px;
            text-align: left;
            line-height: 11px;
            /* identical to box height, or 61% */
            color: #FF3D5A;
            letter-spacing: -0.66px;
            
            color: #939495;">Complete Set Up</p>
        </div>
        <!-- <div class="col-2"><i class="fa fa-check" style="color:white; padding:2px; margin: 15px; background-color: #15B91F;
            border-radius:50%;"></i></div>
         -->
    </li>
</ul>

</div>
<div class="col-lg-4 col-xs-9 col-md-6 col-sm-9 p-4 m-3">

<div class="justify-content-left" style="
  ">
    <h4 style="margin:20px;">Complete Set Up</h4>
   
   
   
<div class="row justify-content-center" style="margin:5px;">

 
  
    
  </div>
  
  <div class="row justify-content-center" style="margin: 10px;
  border: 1px solid #DADADA;
box-sizing: border-box;
padding:10px;
border-radius: 8px;
width: 470px;
height:fit-content;
  ">
  <form methdo="GET" action="{{route('business.c3.page')}}">
<p>Please review the terms of our contract</p>
  <label class="lbl2">

    * Interpretation

    * In these Conditions:
    “App” means the mobile application made available to Users to implement the Retailer's digital loyalty card.
    “Commencement Date” means the date from which the Services shall be provided and as set out on the Order Form.
    “Conditions” means Squid Rewards’ terms and conditions as
    set out in this document and that apply to the Retailer.
    
    “Free Trial Period” shall be as set out on the Order Form.
    “Initial Subscription Period” shall be as set out on the Order Form.
  </label>

  <div style="padding:5px; margin:5px;">
    
    <label for="subscribeNews"> <input type="checkbox" id="subscribeNews" name="subscribe" value="newsletter">  I have read and agree to the Terms and Conditions of the Loyal IOM Free Trial and Subscription Plan</label>
  </div>
  
       </div>
   
       <div class="row justify-content-center" style="margin-top: 30px;">
    
        <button  class="btn btn-outline-danger" style=" color:white; border : 0.88px rgba(128, 128, 128, 0.5) solid; width:420px; height: 40px; margin: 0px 0px 0px 0px ;  font-size: 12px; background: linear-gradient(0deg, #FF3D5A, #FF3D5A);
        box-shadow: 0px 2px 19px 2px rgba(59, 23, 165, 0.308239);
        border-radius: 6px;">Next      --&gt; </button>
      </div>
      </div>
</from>
</div>
</div>
  
</div>

</section>


</body>
</html>

