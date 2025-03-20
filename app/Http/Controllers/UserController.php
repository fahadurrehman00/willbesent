<?php

namespace App\Http\Controllers;

use App\Models\CouponDiscount;
use App\Models\Document;
use App\Models\Recipient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userProfile(){
        return view('user-profile');
    }

    public function dashboard(){
        $recipients = Recipient::where('user_id', Auth::user()->id)->get();
        return view('dashboard', compact('recipients'));
    }

    public function getAllUsers()
    {
        try {
            $users = User::where('id', '!=', Auth::id())->get(); // Exclude logged-in user
            $documents = Document::count(); // Count all documents
            $recipients = Recipient::count(); // Count all recipients

            return response()->json([
                'users' => $users,
                'totalDocuments' => $documents,
                'totalRecipients' => $recipients,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch users'], 500);
        }
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            auth()->user()->update(['profile_image' => $imagePath]);

            return response()->json([
                'profile_image' => asset('storage/' . $imagePath),
                'message' => 'Profile image updated successfully.',
            ]);
        }

        return response()->json(['message' => 'No image uploaded.'], 400);
    }

    public function updateUserDetails(Request $request)
    {
        $user = auth()->user();
        $user->update($request->all());

        return response()->json([
            'message' => 'Profile updated successfully!',
            'user' => $user
        ]);
    }

    public function adminUpdateuser(Request $request, $id)
    {
        $user =User::find($id);
        $user->update($request->all());

        return response()->json([
            'message' => 'Profile updated successfully!',
            'user' => $user
        ]);
    }


    public function updateUser(Request $request)
    {
        $user = auth()->user();
        $user->update($request->all());

        return redirect()->back()->with('success', 'Your profile image has been uploaded!');
    }

    public function getLoggedInUser()
    {
        try {
            $user = auth()->user();  // Get the logged-in user details
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user details'], 500);
        }
    }

    public function getAllCopon()
    {
        try {
            $user = auth()->user();  // Get the logged-in user details
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user details'], 500);
        }
    }

    public function storeCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required',
            'discount_percentage' => 'required',
        ]);
        $user = auth()->user();
        $user_coupon = new CouponDiscount();
        $user_coupon->coupon_code= $request->coupon_code;
        $user_coupon->discount_percentage= $request->discount_percentage;
        $user_coupon->user_id= $user->id;
        $user_coupon->save();

        return response()->json($user_coupon, 200);
    }

    public function deleteCoupon($id)
    {
        try {
            $coupon = CouponDiscount::find($id);

            if (!$coupon) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $coupon->delete();
            return redirect()->back()->with('success', 'coupon deleted successfully.');


        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete coupon'], 500);
        }
    }

    public function adminDeleteUser($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete coupon'], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $user->delete();

            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete user'], 500);
        }
    }
    public function userDetails($id)
    {
        $user = User::with(['documents', 'recipients','subscriptions','transactions'])->find($id);
        if (!$user) {
            return redirect()->route('admin.dashboard')->with('error', 'User not found.');
        }

        return view('admin.user-details', ['user' => $user]);
    }


        public function adminProfile()
    {
        $coupon= CouponDiscount::all();
        $user= auth()->user();
        return view('admin.admin-profile', ['coupon' => $coupon, 'user' => $user]);
    }

    public function adminProfileUpdate(Request $request,$id)
    {
        $user = User::where('id', $id)->first();
        $user_data['firstname'] = $request->firstname;
        $user_data['lastname'] = $request->lastname;
        $user_data['email'] = $request->email;
        $user_data['phone'] = $request->phone;

        if ($request->hasfile('profileImage')) {
            $file = $request->file('profileImage');
            $extension = $file->getClientOriginalName();
            $filename = time() . '.' . $extension;
            $file->move(base_path('public/images/userProfile'), $filename);
            $user_data['profile_image'] = $filename;
        } else {
            $user_data['profile_image'] = $request->old_image;
        }
        $user->update($user_data);
        return redirect()->route('admin.profile');

    }

    public function verificationView()
    {
        // if (!Auth::check()) {
        //     return redirect()->route('login'); 
        // }

        $user = User::where('id', Auth::user()->id)->get();
        return view('verification');
    }


    public function verifyPin(Request $request)
    {
        $user = Auth::user();
        $enteredPin = $request->pin1 . $request->pin2 . $request->pin3 . $request->pin4;
        
        if ($user->pincode == $enteredPin) {
            $user->update(['userStatus' => true]);
            return response()->json(['success' => true, 'message' => 'Verification successful']);
        }
        
        return response()->json(['success' => false, 'message' => 'Invalid PIN code']);
    }

}

