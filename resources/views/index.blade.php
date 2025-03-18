<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CS7WD2PKNZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-CS7WD2PKNZ');
    </script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Will Be Sent | Will Distribution And Storage</title>
    <meta name="description" content="willbesent" />
    <meta name="keywords" content="willbesent" />
    <meta name="author" content="willbesent" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- favicon -->
    <link href="{{ asset('images/WBS-Logo.png') }}" rel="shortcut icon" />
    <!-- Main Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Navbar Start -->
    <nav id="navbar" class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('images/WBS-Logo.png') }}" class="h-14" alt="WBS Logo" />
                </a>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden text-gray-800 focus:outline-none" type="button" id="mobile-menu-button"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <i class="fas fa-bars text-2xl"></i>
                </button>

                <!-- Navigation Links -->
                <div class="hidden lg:flex flex-grow justify-center items-center space-x-6" id="navbarCollapse">
                    <ul class="flex flex-col lg:flex-row items-center gap-4 lg:gap-6">
                        <li>
                            <a href="#services"
                                class="text-gray-700 hover:text-[#415a77] font-medium transition">Services</a>
                        </li>
                        <li>
                            <a href="#pricing"
                                class="text-gray-700 hover:text-[#415a77] font-medium transition">Pricing</a>
                        </li>
                        <li>
                            <a href="#testimonial"
                                class="text-gray-700 hover:text-[#415a77] font-medium transition">Reviews</a>
                        </li>
                        <!-- <li>
                            <a href="#blog" class="text-gray-700 hover:text-[#415a77] font-medium transition">Blog</a>
                        </li> -->
                        <li>
                            <a href="#contact" class="text-gray-700 hover:text-primary font-medium transition"
                                onclick="document.querySelector('#contact').scrollIntoView({ behavior: 'smooth' })">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Login/Signup -->
                <div class="hidden lg:flex space-x-4">
                    @if (Auth::check())
                        <a href="/dashboard"
                            class="px-4 py-2 bg-[#415a77] text-white font-medium rounded-lg hover:bg-[#f47d61] transition-all duration-300">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 bg-[#415a77] text-white font-medium rounded-lg hover:bg-[#f47d61] transition-all duration-300">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 bg-[#415a77] text-white font-medium rounded-lg hover:bg-[#f47d61] transition-all duration-300">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 bg-[#f47d61] text-white font-medium rounded-lg hover:bg-[#415a77] transition-all duration-300">
                            Signup
                        </a>
                    @endif
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="lg:hidden hidden flex-col mt-4 space-y-4" id="mobile-menu">
                <ul class="flex flex-col items-center gap-4">
                    <li>
                        <a href="#services" class="text-gray-700 hover:text-primary font-medium transition">Services</a>
                    </li>
                    <li>
                        <a href="#pricing" class="text-gray-700 hover:text-primary font-medium transition">Pricing</a>
                    </li>
                    <li>
                        <a href="#testimonial"
                            class="text-gray-700 hover:text-primary font-medium transition">Reviews</a>
                    </li>
                    <li>
                        <a href="#blog" class="text-gray-700 hover:text-primary font-medium transition">Blog</a>
                    </li>
                    <li>
                        <a href="#contact" class="text-gray-700 hover:text-primary font-medium transition"
                            onclick="document.querySelector('#contact').scrollIntoView({ behavior: 'smooth' })">Contact</a>
                    </li>
                </ul>
                <div class="flex space-x-4 mt-4 justify-center">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-[#415a77] text-white font-medium rounded-lg hover:bg-[#f47d61] transition-all duration-300">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-[#415a77] text-white font-medium rounded-lg hover:bg-[#f47d61] transition-all duration-300">Signup</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- =========== Hero Section Start =========== -->
    <section class="relative bg-[url('{{ asset('images/bg2.jpg') }}')] bg-no-repeat bg-cover text-white" id="home">
        <div class="container">
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-x-6 gap-y-10 items-center">
                <div class="">
                    <h1
                        class="text-3xl md:text-5xl/tight lg:text-6xl/tight tracking-normal capitalize leading-normal font-bold max-w-2xl">
                        A Better  To Create, Store, And Send Your Will Is Here
                    </h1>
                    <p class="text-base font-medium text-muted mt-3 capitalize">
                        Using state of the art technologies in compliance with all laws,
                        Will Be Sent is the first platform that allows users to seamlessly
                        create, store, and send a will to recepiants!
                    </p>

                    <div class="flex flex-wrap mt-9 text-center gap-3">
                        <a class="py-2 px-6 bg-[#415a77] text-white font-medium rounded-lg hover:bg-[#f47d61] transition-all duration-300 ease-in-out"
                            href="#pricing">View Pricing</a>
                        <a class="py-2 px-6 bg-[#f47d61] text-white font-medium rounded-lg hover:bg-[#415a77] transition-all duration-300 ease-in-out"
                            href="{{ route('register') }}">Sign up for free</a>
                    </div>
                </div>

                <div class="relative">
                    <img src="{{ asset('images/6.png') }}" class="md:h-[700px] lg:ms-auto mx-auto rounded-lg" />
                </div>
            </div>
        </div>
    </section>

    <!-- Services Start -->
    <section id="services" class="py-20">
        <div class="container">
            <div class="max-w-2xl mx-auto text-center">
                <span
                    class="text-sm text-primary uppercase font-semibold tracking-wider text-default-950">Services</span>
                <h2 class="text-3xl md:text-4xl/tight font-semibold text-black mt-4">
                    All Needed Services, All In One Place
                </h2>
                <p class="text-base font-medium mt-4 text-muted">
                    Will Be Sent offers all services needed to create your perfect
                    emergency plan.
                </p>
            </div>

            <div
                class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-x-3 gap-y-6 md:gap-y-12 lg:gap-y-24 md:pt-20 pt-12">
                <div class="text-center">
                    <div class="flex items-center justify-center">
                        <div
                            class="items-center justify-center flex bg-[#E2E8F0] rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border">
                            <i class="fas fa-file text-4xl text-[#415a77]"></i>
                        </div>
                    </div>
                    <h1 class="text-xl font-semibold pt-4">Full Will</h1>
                    <p class="text-base text-gray-600 mt-2">
                        Upload, save, and send your will.
                    </p>
                </div>

                <div class="text-center">
                    <div class="flex items-center justify-center">
                        <div
                            class="items-center justify-center flex bg-[#E2E8F0] rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border">
                            <i class="fas fa-file-signature text-4xl text-[#415a77]"></i>
                        </div>
                    </div>
                    <h1 class="text-xl font-semibold pt-4">Power Of Attorney</h1>
                    <p class="text-base text-gray-600 mt-2">
                        Create and store your power of attorney.
                    </p>
                </div>

                <div class="text-center">
                    <div class="flex items-center justify-center">
                        <div
                            class="items-center justify-center flex bg-[#E2E8F0] rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border">
                            <i class="fas fa-handshake text-4xl text-[#415a77]"></i>
                        </div>
                    </div>
                    <h1 class="text-xl font-semibold pt-4">Will Executor</h1>
                    <p class="text-base text-gray-600 mt-2">
                        WBS can be the executor for your will.
                    </p>
                </div>

                <div class="text-center">
                    <div class="flex items-center justify-center">
                        <div
                            class="items-center justify-center flex bg-[#E2E8F0] rounded-[49%_80%_40%_90%_/_50%_30%_70%_80%] h-20 w-20 border">
                            <i class="fas fa-certificate text-4xl text-[#415a77]"></i>
                        </div>
                    </div>
                    <h1 class="text-xl font-semibold pt-4">Notarization</h1>
                    <p class="text-base text-gray-600 mt-2">
                        All documents can be notarized.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Services End -->

    <!-- About Start -->
    <section id="about" class="py-20 bg-gray-100">
        <div class="container">
            <div class="grid lg:grid-cols-2 items-center gap-6">
                <div class="lg:ms-5 ms-8">
                    <div>
                        <span
                            class="text-sm text-primary uppercase font-semibold tracking-wider text-default-950">Getting
                            Started</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl/tight font-semibold text-black mt-4">
                        Setting Up Your Will Is As Easy As 1, 2, 3
                    </h2>
                    <p class="text-base font-normal text-muted mt-6">
                        We've revolutionized how easy a start to finish will can be. Try
                        it for free today!
                    </p>

                    <div class="grid lg:grid-cols-3 grid-cols-1 gap-8 mt-9">
                        <div class="">
                            <div class="flex items-center justify-start">
                                <div
                                    class="items-center justify-center flex bg-[#E2E8F0] rounded-full h-20 w-20 border border-dashed border-green-50">
                                    <i class="fas fa-user-plus text-4xl text-[#415a77]"></i>
                                </div>
                            </div>
                            <h1 class="text-xl font-semibold pt-6">1. Sign Up</h1>
                            <p class="text-base text-gray-600 font-normal mt-2">
                                Create a free account to get started!
                            </p>
                        </div>

                        <div class="">
                            <div class="flex items-center justify-start">
                                <div
                                    class="items-center justify-center flex bg-[#E2E8F0] rounded-full h-20 w-20 border border-dashed border-red-50">
                                    <i class="fas fa-user-cog text-4xl text-[#415a77]"></i>
                                </div>
                            </div>
                            <h1 class="text-xl font-semibold pt-6">2. Configure Account</h1>
                            <p class="text-base text-gray-600 font-normal mt-2">
                                Design the account to match your needs!
                            </p>
                        </div>

                        <div class="">
                            <div class="flex items-center justify-start">
                                <div
                                    class="items-center justify-center flex bg-[#E2E8F0] rounded-full h-20 w-20 border border-dashed border-primary/10">
                                    <i class="fas fa-file-alt text-4xl text-[#415a77]"></i>
                                </div>
                            </div>
                            <h1 class="text-xl font-semibold pt-6">3. Choose Docs</h1>
                            <p class="text-base text-gray-600 font-normal mt-2">
                                Select exactly what you need and that's all!
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <img src="{{ asset('images/1.png') }}" class="h-[600px] rounded-xl mx-auto" />
                </div>
            </div>
        </div>
    </section>
    <!-- About End -->

    <!-- Pricing Start -->
    <section id="pricing" class="py-20">
        <div class="container">
            <div class="max-w-2xl mx-auto text-center">
                <div>
                    <span class="text-sm text-primary uppercase font-semibold tracking-wider text-default-950">
                        Pricing
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl/tight font-semibold text-black mt-4">
                    Simple, Straight Forward Pricing
                </h2>
            </div>

            <div class="grid grid-cols-1 mt-8">
                <div id="StarterContent">
                    <div class="mt-14" id="start-month" role="tabpanel" aria-labelledby="start-month-tab">
                        <div class="grid lg:grid-cols-3 grid-cols-1 gap-10">
                            <!-- Full Will -->
                            <div
                                class="flex flex-col shadow-2xl rounded-xl bg-white overflow-hidden hover:bg-[#E2E8F0] transition-all duration-300">
                                <div class="text-center pt-10">
                                    <i class="fas fa-file-alt text-6xl text-[#f47d61] pb-10"></i>
                                    <!-- Font Awesome Icon -->
                                    <h5 class="text-2xl font-semibold text-black">Full Will</h5>
                                    <h2 class="text-5xl mt-5 mb-1 items-center align-middle">
                                        <sup class="text-3xl align-middle">$</sup>
                                        <span>10</span>
                                    </h2>
                                    <span class="text-base font-medium text-muted">per month</span>
                                </div>
                                <div class="flex justify-center px-10 py-10">
                                    <button
                                        class="text-white py-2 px-6 inline-flex rounded-md text-base items-center justify-center border border-primary text-black bg-[#415a77] hover:bg-[#f47d61] transition-all duration-500 font-medium w-full">
                                        Get Started
                                    </button>
                                </div>
                            </div>

                            <!-- Power of Attorney -->
                            <div
                                class="flex flex-col shadow-2xl rounded-xl bg-white overflow-hidden hover:bg-[#E2E8F0] transition-all duration-300">
                                <div class="text-center pt-10">
                                    <i class="fas fa-pen-square text-6xl text-[#f47d61] pb-10"></i>
                                    <!-- Font Awesome Icon -->
                                    <h5 class="text-2xl font-semibold text-black">
                                        Power Of Attorney
                                    </h5>
                                    <h2 class="text-5xl mt-5 mb-1 items-center align-middle">
                                        <sup class="text-3xl align-middle">+ $</sup>
                                        <span>1</span>
                                    </h2>
                                    <span class="text-base font-medium text-muted">per month</span>
                                </div>
                                <div class="flex justify-center px-10 py-10">
                                    <button
                                        class="text-white py-2 px-6 inline-flex rounded-md text-base items-center justify-center border border-primary text-black bg-[#415a77] hover:bg-[#f47d61] transition-all duration-500 font-medium w-full">
                                        Get Started
                                    </button>
                                </div>
                            </div>

                            <!-- Executor of Will -->
                            <div
                                class="flex flex-col shadow-2xl rounded-xl bg-white overflow-hidden hover:bg-[#E2E8F0] transition-all duration-300">
                                <div class="text-center pt-10">
                                    <i class="fas fa-user-shield text-6xl text-[#f47d61] pb-10"></i>
                                    <!-- Font Awesome Icon -->
                                    <h5 class="text-2xl font-semibold text-black">
                                        Executor Of Will
                                    </h5>
                                    <h2 class="text-5xl mt-5 mb-1 items-center align-middle">
                                        <sup class="text-3xl align-middle">+ $</sup>
                                        <span>1</span>
                                    </h2>
                                    <span class="text-base font-medium text-muted">per month</span>
                                </div>
                                <div class="flex justify-center px-10 py-10">
                                    <button
                                        class="text-white py-2 px-6 inline-flex rounded-md text-base items-center justify-center border border-primary text-black bg-[#415a77] hover:bg-[#f47d61] transition-all duration-500 font-medium w-full">
                                        Get Started
                                    </button>
                                </div>
                            </div>

                            <!-- Notarization -->
                            <div
                                class="flex flex-col shadow-2xl rounded-xl bg-white overflow-hidden hover:bg-[#E2E8F0] transition-all duration-300">
                                <div class="text-center pt-10">
                                    <i class="fas fa-pencil-alt text-6xl text-[#f47d61] pb-10"></i>
                                    <!-- Font Awesome Icon -->
                                    <h5 class="text-2xl font-semibold text-black">
                                        Notarization
                                    </h5>
                                    <h2 class="text-5xl mt-5 mb-1 items-center align-middle">
                                        <sup class="text-3xl align-middle">$</sup>
                                        <span>25</span>
                                    </h2>
                                    <span class="text-base font-medium text-muted">per document</span>
                                </div>
                                <div class="flex justify-center px-10 py-10">
                                    <button
                                        class="text-white py-2 px-6 inline-flex rounded-md text-base items-center justify-center border border-primary text-black bg-[#415a77] hover:bg-[#f47d61] transition-all duration-500 font-medium w-full">
                                        Get Started
                                    </button>
                                </div>
                            </div>

                            <!-- DWP Will -->
                            <div
                                class="flex flex-col shadow-2xl rounded-xl bg-white overflow-hidden hover:bg-[#E2E8F0] transition-all duration-300">
                                <div class="text-center pt-10">
                                    <i class="fas fa-book text-6xl text-[#f47d61] pb-10"></i>
                                    <!-- Font Awesome Icon -->
                                    <h5 class="text-2xl font-semibold text-black">
                                        Document Writter Drafted Will
                                    </h5>
                                    <h2 class="text-5xl mt-5 mb-1 items-center align-middle">
                                        <sup class="text-3xl align-middle">$</sup>
                                        <span>250</span>
                                    </h2>
                                    <span class="text-base font-medium text-muted">per will</span>
                                </div>
                                <div class="flex justify-center px-10 py-10">
                                    <button
                                        class="text-white py-2 px-6 inline-flex rounded-md text-base items-center justify-center border border-primary text-black bg-[#415a77] hover:bg-[#f47d61] transition-all duration-500 font-medium w-full">
                                        Get Started
                                    </button>
                                </div>
                            </div>

                            <!-- Lawyer Drafted Will -->
                            <div
                                class="flex flex-col shadow-2xl rounded-xl bg-white overflow-hidden hover:bg-[#E2E8F0] transition-all duration-300">
                                <div class="text-center pt-10">
                                    <i class="fas fa-gavel text-6xl text-[#f47d61] pb-10"></i>
                                    <!-- Font Awesome Icon -->
                                    <h5 class="text-2xl font-semibold text-black">
                                        Lawyer Drafted Will
                                    </h5>
                                    <h2 class="text-5xl mt-5 mb-1 items-center align-middle">
                                        <sup class="text-3xl align-middle">$</sup>
                                        <span>450</span>
                                    </h2>
                                    <span class="text-base font-medium text-muted">per will</span>
                                </div>
                                <div class="flex justify-center px-10 py-10">
                                    <button
                                        class="text-white py-2 px-6 inline-flex rounded-md text-base items-center justify-center border border-primary text-black bg-[#415a77] hover:bg-[#f47d61] transition-all duration-500 font-medium w-full">
                                        Get Started
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing End-->

    <!-- Testimonial Start -->
    <section id="testimonial" class="py-20 bg-gray-100">
        <div class="container">
            <div class="text-center max-w-xl mx-auto">
                <span
                    class="text-sm text-primary uppercase font-semibold tracking-wider text-default-950">Reviews</span>
                <h2 class="text-3xl md:text-4xl font-semibold mt-4">
                    Customer Success, Customer Satisfaction
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 mt-14 items-center">
                <div class="relative">
                    <div class="rounded-md relative px-1">
                        <div class="flex justify-between gap-3 flex-col md:flex-row">
                            <!-- Testimonial 1 -->
                            <div
                                class="p-6 rounded-xl border border-default-200 flex flex-col justify-between bg-white transition-all duration-300 hover:bg-[#E2E8F0]">
                                <div>
                                    <h3 class="text-xl font-semibold text-default-950">
                                        Effortless and Secure
                                    </h3>
                                    <p class="text-base font-normal mt-4 mb-4 text-muted">
                                        Will Be Sent made creating my will so easy. The
                                        step-by-step online process was straightforward, and I
                                        felt reassured knowing my documents are safely stored.
                                        Highly recommend!
                                    </p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <!-- <div class="text-primary text-3xl">
                                        <i class="fas fa-user-shield"></i>
                                    </div> -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-primary">
                                            Ethan W.
                                        </h3>
                                        <p class="text-sm font-medium mt-1">
                                            Asheville, North Carolina
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 2 -->
                            <div
                                class="p-6 rounded-xl border border-default-200 flex flex-col justify-between bg-white transition-all duration-300 hover:bg-[#E2E8F0]">
                                <div>
                                    <h3 class="text-xl font-semibold text-default-950">
                                        Perfect for Busy Professionals
                                    </h3>
                                    <p class="text-base font-normal mt-4 mb-4 text-muted">
                                        As someone with a packed schedule, I appreciated how quick
                                        and intuitive the platform was. It took less than an hour
                                        to get everything in place, and their customer support was
                                        excellent.
                                    </p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <!-- <div class="text-primary text-3xl">
                                        <i class="fas fa-briefcase"></i>
                                    </div> -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-primary">
                                            Sophia B.
                                        </h3>
                                        <p class="text-sm font-medium mt-1">Boulder, Colorado</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 3 -->
                            <div
                                class="p-6 rounded-xl border border-default-200 flex flex-col justify-between bg-white transition-all duration-300 hover:bg-[#E2E8F0]">
                                <div>
                                    <h3 class="text-xl font-semibold text-default-950">
                                        Peace of Mind at Last
                                    </h3>
                                    <p class="text-base font-normal mt-4 mb-4 text-muted">
                                        I’d been putting off writing my will for years, but Will
                                        Be Sent changed that. Their service is affordable,
                                        reliable, and gave me the peace of mind I needed for my
                                        family’s future.
                                    </p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <!-- <div class="text-primary text-3xl">
                                        <i class="fas fa-home"></i>
                                    </div> -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-primary">
                                            Jameson C.
                                        </h3>
                                        <p class="text-sm font-medium mt-1">Savannah, Georgia</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial 4 -->
                            <div
                                class="p-6 rounded-xl border border-default-200 flex flex-col justify-between bg-white transition-all duration-300 hover:bg-[#E2E8F0]">
                                <div>
                                    <h3 class="text-xl font-semibold text-default-950">
                                        A Lifesaver for Families
                                    </h3>
                                    <p class="text-base font-normal mt-4 mb-4 text-muted">
                                        After using Will Be Sent, I feel confident that my family
                                        will have everything they need when the time comes. The
                                        online storage is an added bonus—it’s convenient and
                                        secure.
                                    </p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <!-- <div class="text-primary text-3xl">
                                        <i class="fas fa-users"></i>
                                    </div> -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-primary">
                                            Olivia M.
                                        </h3>
                                        <p class="text-sm font-medium mt-1">Eugene, Oregon</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button at the bottom of the section -->
        <div class="text-center mt-12">
            <button
                class="py-3 px-8 rounded-md text-white font-medium bg-[#415a77] hover:bg-[#f47d61] transition-all duration-300">
                Get Started <i class="mdi mdi-arrow-right ms-2"></i>
            </button>
        </div>
    </section>

    <!-- Testimonial End -->

    <!-- Blog Start -->
    <section id="blog" class="py-20">
        <div class="container">
            <div class="">
                <div class="text-center max-w-xl mx-auto">
                    <span
                        class="text-sm text-primary uppercase font-semibold tracking-wider text-default-950">Blog</span>
                    <h2 class="text-3xl md:text-4xl/tight font-semibold mt-4">
                        Newest Updates On The Industry
                    </h2>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6 mt-14 items-center">
                <div class="bg-white rounded-xl border">
                    <div class="relative">
                        <img class="rounded-t-xl" src="assets/images/blog/05.jpg" alt="" />
                    </div>
                    <div class="flex py-6 px-6">
                        <div>
                            <a href="#" class="text-xl text-black font-semibold line-clamp-2">5 Common Myths
                                About Writing a Will – Debunked!</a>
                            <p class="mt-4 mb-6 text-gray-500 leading-6">
                                Many people delay creating a will due to misconceptions about
                                the process. In this post, we address common myths like “I’m
                                too young to need a will” and “Wills are only for the
                                wealthy.” Learn why planning ahead is essential for everyone,
                                no matter your age or income.
                            </p>

                            <div class="flex items-center justify-between gap-3 mt-4">
                                <div class="flex items-center">
                                    <!-- <img src="{{ asset('images/user.png') }}" class="h-10 w-10 me-4 rounded-full"
                                        alt="" /> -->
                                    <a href="#"
                                        class="text-black text-sm font-semibold pb-1 hover:underline hover:text-primary transition-all duration-300">
                                        Lila Grayson</a>
                                </div>
                                <!--<p class="flex font-medium text-muted">August 2</p>-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border">
                    <div class="relative">
                        <img class="rounded-t-xl" src="assets/images/blog/07.jpg" alt="" />
                    </div>
                    <div class="flex py-6 px-6">
                        <div>
                            <a href="#" class="text-xl text-black font-semibold line-clamp-2">How Digital Will
                                Storage Protects Your Legacy</a>
                            <p class="mt-4 mb-6 text-gray-500 leading-6">
                                In today’s digital age, storing your will online offers
                                unmatched security and convenience. This blog explores how
                                online storage ensures your documents are accessible, safe
                                from physical damage, and easily shareable with designated
                                executors and family members.
                            </p>

                            <div class="flex items-center justify-between gap-3 mt-4">
                                <div class="flex items-center">
                                    <!-- <img src="{{ asset('images/user.png') }}" class="h-10 w-10 me-4 rounded-full"
                                        alt="" /> -->
                                    <a href="#"
                                        class="text-black text-sm font-semibold pb-1 hover:underline hover:text-primary transition-all duration-300">
                                        Lila Grayson</a>
                                </div>
                                <!--<p class="flex font-medium text-muted">August 3</p>-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border">
                    <div class="relative">
                        <img class="rounded-t-xl" src="assets/images/blog/04.jpg" alt="" />
                    </div>
                    <div class="flex py-6 px-6">
                        <div>
                            <a href="#" class="text-xl text-black font-semibold line-clamp-2">10 Life Events
                                That Signal It’s Time to Update Your Will</a>
                            <p class="mt-4 mb-6 text-gray-500 leading-6">
                                Your life changes—and so should your will. From getting
                                married to welcoming a new child or starting a business, this
                                post highlights key milestones when updating your will is
                                crucial to keeping your estate plans current and
                                comprehensive.
                            </p>

                            <div class="flex items-center justify-between gap-3 mt-4">
                                <div class="flex items-center">
                                    <!-- <img src="{{ asset('images/user.png') }}" class="h-10 w-10 me-4 rounded-full"
                                        alt="" /> -->
                                    <a href="#"
                                        class="text-black text-sm font-semibold pb-1 hover:underline hover:text-primary transition-all duration-300">
                                        Lila Grayson</a>
                                </div>
                                <!--<p class="flex font-medium text-muted">August 8</p>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog End -->

    <!-- Contact Start -->
    <section id="contact" class="py-20 bg-gray-100">
        <div class="container">
            <div class="grid lg:grid-cols-3 gap-6 items-center">
                <!-- Contact Info -->
                <div>
                    <div>
                        <span
                            class="text-sm text-primary uppercase font-semibold tracking-wider text-default-950 mb-6">Contact
                            Us</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-semibold mt-4 text-gray-800">
                        Your Questions, Our Support
                    </h2>

                    <div class="flex flex-col sm:flex-row items-center gap-5 text-center sm:text-start mt-10">
                        <!-- <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                            <i data-lucide="map-pin" class="text-2xl text-primary"></i>
                        </div> -->
                        <div>
                            <h5 class="text-base text-muted font-medium mb-1">
                                255 South Orange Avenue, Suite 104 - 1715, Orlando, FL 32801
                            </h5>
                            <a href="#"
                                class="text-xs text-primary font-bold uppercase hover:text-primaryDark">Address</a>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-5 text-center sm:text-start mt-10">
                        <!-- <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                            <i data-lucide="mail" class="text-2xl text-primary"></i>
                        </div> -->
                        <div>
                            <h5 class="text-base text-muted font-medium mb-1">
                                Help@WillBeSent.com
                            </h5>
                            <a href="#"
                                class="text-xs text-primary font-bold uppercase hover:text-primaryDark">Email</a>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-5 text-center sm:text-start mt-10">
                        <!-- <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                            <i data-lucide="smartphone" class="text-2xl text-primary"></i>
                        </div> -->
                        <div>
                            <h5 class="text-base text-muted font-medium mb-1">
                                +1 (833) 462-2786
                            </h5>
                            <a href="#"
                                class="text-xs text-primary font-bold uppercase hover:text-primaryDark">Phone</a>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="lg:col-span-2 lg:ms-24">
                    <div class="p-8 md:p-12 rounded-lg shadow-xl bg-white border border-gray-200">
                        <form>
                            <div class="grid sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="formFirstName"
                                        class="block text-sm font-semibold text-black mb-2">First Name</label>
                                    <input type="text"
                                        class="block w-full text-sm rounded-md py-3 px-4 border border-gray-200 focus:border-gray-300 focus:ring-primary"
                                        id="formFirstName" placeholder="Your first name..." required />
                                </div>

                                <div>
                                    <label for="formLastName" class="block text-sm font-semibold text-black mb-2">Last
                                        Name</label>
                                    <input type="text"
                                        class="block w-full text-sm rounded-md py-3 px-4 border border-gray-200 focus:border-gray-300 focus:ring-primary"
                                        id="formLastName" placeholder="Your last name..." required />
                                </div>

                                <div>
                                    <label for="formEmail" class="block text-sm font-semibold text-black mb-2">Email
                                        Address</label>
                                    <input type="email"
                                        class="block w-full text-sm rounded-md py-3 px-4 border border-gray-200 focus:border-gray-300 focus:ring-primary"
                                        id="formEmail" placeholder="Your email..." required />
                                </div>

                                <div>
                                    <label for="formPhone" class="block text-sm font-semibold text-black mb-2">Phone
                                        Number</label>
                                    <input type="text"
                                        class="block w-full text-sm rounded-md py-3 px-4 border border-gray-200 focus:border-gray-300 focus:ring-primary"
                                        id="formPhone" placeholder="Your phone number..." required />
                                </div>

                                <div class="sm:col-span-2">
                                    <div class="mb-4">
                                        <label for="formMessages"
                                            class="block text-sm font-semibold text-black mb-2">Message</label>
                                        <textarea
                                            class="block w-full text-sm rounded-md py-3 px-4 border border-gray-200 focus:border-gray-300 focus:ring-primary"
                                            id="formMessages" rows="4" placeholder="Your message..." required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit"
                                    class="py-3 px-8 rounded-md text-white text-base font-medium bg-gradient-to-r from-[#f47d61] to-[#415a77] hover:bg-gradient-to-r hover:from-[#415a77] hover:to-[#f47d61] transition-all duration-300 ease-in-out">
                                    Send Message <i class="mdi mdi-send ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact End -->

    <!-- Footer Start -->
    <!-- <footer class="bg-[#415a77]">
        <div class="container">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 py-4">
                <div class="col-span-full lg:col-span-2">
                    <div class="max-w-2xl mx-auto">
                        <div class="flex items-center">
                            <img src="{{ asset('images/WBS-Logo.png') }}" alt="" class="h-10 me-5" />
                        </div>
                        <p class="text-gray-300 max-w-xs mt-6">
                            Will Be Sent is a proud subsidary of
                            <a herf="" target="blank" href="https://arvoequities.com">Arvo Equities.</a>
                        </p>
                    </div>

                    <div class="mt-6 grid space-y-3">
                        <a class="inline-flex items-center gap-x-4 text-gray-300 hover:text-gray-400 transition-all duration-300"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                            Help@WillBeSent.com
                        </a>

                        <a class="inline-flex items-center gap-x-4 text-gray-300 hover:text-gray-400 transition-all duration-300"
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            + 1 (833) 462 2786
                        </a>
                    </div>
                </div>

                <div class="col-span-1">
                    <h4 class="font-semibold text-gray-100 uppercase">Pages</h4>

                    <div class="mt-6 grid space-y-3">
                        <p>
                            <a class="inline-flex gap-x-2 text-base text-gray-300 hover:text-gray-400 transition-all duration-300"
                                href="#">Services</a>
                        </p>
                        <p>
                            <a class="inline-flex gap-x-2 text-base text-gray-300 hover:text-gray-400 transition-all duration-300"
                                href="#">Pricing</a>
                        </p>
                        <p>
                            <a class="inline-flex gap-x-2 text-base text-gray-300 hover:text-gray-400 transition-all duration-300"
                                href="#">Reviews</a>
                        </p>
                        <p>
                            <a class="inline-flex gap-x-2 text-base text-gray-300 hover:text-gray-400 transition-all duration-300"
                                href="#">Contact</a>
                        </p>
                    </div>
                </div>
                <div class="col-span-1">
                    <h4 class="font-semibold text-gray-100 uppercase">Policies</h4>

                    <div class="mt-6 grid space-y-3">
                        <p>
                            <a class="inline-flex gap-x-2 text-base text-gray-300 hover:text-gray-400 transition-all duration-300"
                                href="#">Privacy Policy</a>
                        </p>
                        <p>
                            <a class="inline-flex gap-x-2 text-base text-gray-300 hover:text-gray-400 transition-all duration-300"
                                href="#">Terms & Conditions</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#f47d61]">
            <div class="container">
                <div class="flex justify-between items-center">
                    <p class="text-base text-white">
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        © Will Be Sent. <a href="willbesent.com">All Rights Reserved.</a>
                    </p>

                    <div class="flex gap-2">
                        <a class="p-2 text-sm font-semibold rounded-md text-white hover:bg-[#415a77] transition-all duration-300"
                            href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg>
                        </a>
                        <a class="p-2 text-sm font-semibold rounded-md text-white hover:bg-[#415a77] transition-all duration-300"
                            href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                            </svg>
                        </a>
                        <a class="p-2 text-sm font-semibold rounded-md text-white hover:bg-[#415a77] transition-all duration-300"
                            href="#">
                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->
    @include('components.footer')
    <!-- Footer End -->
    <script src="//code.tidio.co/oohi4ck9zmzjoekpsft3cp6h9cnitwej.js" async></script>
    <script>
        // Toggle Mobile Menu
        document.getElementById('mobile-menu-button').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
