<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>WBS | Verification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="{{ asset('images/WBS-Logo.png') }}" rel="shortcut icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="wrappper justify-center items-center h-screen">
    @include('components.user-header')
        
        <main class="flex justify-center items-center bg-gray-100 py-36">
            <section class="bg-white p-6 rounded-lg shadow-lg w-[32rem] text-center">
                <h2 class="text-2xl font-semibold mb-4">Enter Pin Code to Verify</h2>
                <div class="flex justify-center space-x-2 mb-4">
                    <input type="text" maxlength="1" class="pincode-input w-12 h-12 text-center text-xl border rounded-lg" />
                    <input type="text" maxlength="1" class="pincode-input w-12 h-12 text-center text-xl border rounded-lg" />
                    <input type="text" maxlength="1" class="pincode-input w-12 h-12 text-center text-xl border rounded-lg" />
                    <input type="text" maxlength="1" class="pincode-input w-12 h-12 text-center text-xl border rounded-lg" />
                </div>
                <button id="verifyBtn" class="bg-[#415A77] text-white px-6 py-2 rounded-lg hover:bg-[#F47D61] transition-all duration-300">Verify</button>
                <p class="text-sm mt-4 text-gray-700"> "Please enter your pin. If you're unable to do so, a member of our team will reach out shortly to confirm. You can change your pin or the frequency of this verification in your account. Please reach out to <a to="help@willbesent.com">help@willbesent.com</a> for assistance!"</p>
            </section>
        </main>
        
        @include('components.footer')
    </div>
    
    <script>
       document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll(".pincode-input");
    inputs.forEach((input, index) => {
        input.addEventListener("input", (e) => {
            if (e.inputType !== "deleteContentBackward" && input.value) {
                if (index < inputs.length - 1) inputs[index + 1].focus();
            }
        });
        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    // Add this new code for the verify button
    document.getElementById("verifyBtn").addEventListener("click", function() {
        const pin1 = document.querySelectorAll(".pincode-input")[0].value;
        const pin2 = document.querySelectorAll(".pincode-input")[1].value;
        const pin3 = document.querySelectorAll(".pincode-input")[2].value;
        const pin4 = document.querySelectorAll(".pincode-input")[3].value;
        
        // Check if all fields are filled
        if (!pin1 || !pin2 || !pin3 || !pin4) {
            alert("Please enter all 4 digits of the PIN code");
            return;
        }
        
        // Send AJAX request to verify PIN
        fetch('{{ route("user.verify-pin") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                pin1: pin1,
                pin2: pin2,
                pin3: pin3,
                pin4: pin4
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = '{{ route("dashboard") }}';
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred during verification');
        });
    });
});
    </script>
</body>
</html>
