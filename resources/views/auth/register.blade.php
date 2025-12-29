<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Create Account</h2>
        <p class="text-gray-500 text-sm mt-2">Join us to start managing your events</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input id="name" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none" 
                   type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input id="email" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none" 
                   type="email" name="email" :value="old('email')" required placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input id="password" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none" 
                   type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input id="password_confirmation" class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 outline-none" 
                   type="password" name="password_confirmation" required placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Sign Up
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline transition ease-in-out duration-150" href="{{ route('login') }}">
                    Log in
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>