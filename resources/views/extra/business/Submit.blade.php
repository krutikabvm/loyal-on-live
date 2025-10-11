

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


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

.login-wrap.p-2.p-md-5 {

    margin:auto;
    padding:auto;
    background-color: white;
    border-radius: 6px
}

</style>

<body style="background-color: #7E8190; ">
<section class="ftco-section">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 ">
<div class=" d-flex justify-content-end mb-3 mt-2" > <button type="button" class="btn btn-outline-danger d-flex justify-content-end"onclick="window.location.href='Login.html';"
                  style="border:1px white solid; background-color: white;"
                  >Log out</button>
                 </div>
           
</div>
</div>
<div class="row justify-content-center">
<div class="col-md-6 col-lg-5" style="    background-color: white;
    padding: 0px;
    margin: 0px;">
<div class="login-wrap ">
  
<h3 class="text-center mb-4">   <h4 class="d-flex justify-content-center" style="text-align: center;"> Once you receive you Loyal IOM tags you can return to this page to activate your account!</h4>
</h3>
<p class="d-flex justify-content-center" style="text-align: center; color:rgba(128, 128, 128, 0.431);">(30 days free trial will start 
upon account activation)</p>
<div style="background-color: #F5F5F5; height:100%; width:100%;">
<h3 class="text-center ">   <h4 class="d-flex justify-content-center" style="text-align: center; color:grey; padding:12px;">     (30 days free trial will start 
upon account activation)</h4>
</h3>
<p class="d-flex justify-content-center" style="text-align: center; color:deeppink;    margin: 0px;
    padding: 5px;">support@loyal-iom.com</p>
<div>
<form action="#" class="login-form">



</div>



</form>
</div>
</div>
</div>
</div>
</section>

   

</body>
</html>

