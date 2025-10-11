<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Plans;
use App\Models\Business;
use App\Models\Notifications;
use App\Models\Loyalty_Scheme;
use App\Models\Loyalty_location;
use App\Models\Customer_Loyalty;
use App\Models\BusinessDetails;
use App\Models\AdsBanner;
use Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Session;
use App\Models\UserAppSettings;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\Middleware\AuthTokenMiddleware;
use Google\Auth\FetchAuthTokenInterface;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;



class AdBannerController extends Controller
{
    //get all business
    public function index()
    {
        $banners = AdsBanner::all();
        return view("ad_banner.index")->with(array("banners" =>$banners));
    }

    public function create()
    {
        return view("ad_banner.create")->with(array("banners" =>[]));
    }

    public function store(Request $request){


        $request->validate([
            'advert_name' => 'required|string|max:255',
            'url' => 'required',
            'url.*' => 'url',
            'notification_img' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);


        $img_url = "";
        if (!empty($_FILES['notification_img']['name'])) {
            if ($request->has('notification_img')) {
                $imageName = time() . '.' . $request->notification_img->extension();
                $img = 'images/ads_banner/' . $imageName;
                $request->notification_img->move(public_path('images/ads_banner'), $imageName);
                $img_url = url('/images/ads_banner/' . $imageName);
            }
        } else {
            $img = @$request->get('img_link');
            $img_url = @$request->get('img_link');
        }


        $ads_banners = new AdsBanner();
        $ads_banners->advert_name = @$request->get('advert_name');
        $ads_banners->url = @$request->get('url');
        $ads_banners->img = @$img;
        $ads_banners->save();

        return redirect("admin/ads_banner")->withSuccess('Notification Sent Successfully!');


    }

    public function edit($id)
    {
        $banner = AdsBanner::findOrFail($id);
        return view('ad_banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'advert_name' => 'required|string|max:255',
            'url' => 'nullable',
            'url.*' => 'url',
            'notification_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $banner = AdsBanner::findOrFail($id);
        $banner->advert_name = $request->advert_name;
        $banner->url = $request->url;

        if ($request->hasFile('notification_img')) {
            $image = $request->file('notification_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/banners'), $imageName);
            $banner->img = 'uploads/banners/' . $imageName;
        }

        $banner->save();

        return redirect("admin/ads_banner")->with('success', 'Banner updated successfully!');
    }

    public function destroy($id)
    {
        $banner = AdsBanner::findOrFail($id);
        $banner->delete();
        return redirect("admin/ads_banner")->with('success', 'Banner deleted successfully!');
    }
}
