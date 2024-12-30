<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'chosen' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'chosen' : '' }}">About</a>
            <a href="{{ route('book.create') }}"
                class="{{ request()->routeIs(patterns: 'book.create') ? 'chosen' : '' }}">Explore Books</a>
            <a href="{{ route('contact') }}"
                class="{{ request()->routeIs(patterns: 'contact') ? 'chosen' : '' }}">Contact</a>
        </div>

        <div class="box">
            <h3>extra links</h3>
            @if (Auth::check())
                <a href="{{ route('borrow') }}"
                    class="{{ request()->routeIs(patterns: 'borrow') ? 'chosen' : '' }}">Borrow
                    Status</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('signup') }}">Register</a>
            @endif
        </div>

        <div class="box">
            <h3>contact info</h3>
            <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
            <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
            <p> <i class="fas fa-envelope"></i> tr.a.nt.a.i.sgr.pkts.mail@gmail.com </p>
            <p> <i class="fas fa-map-marker-alt"></i> Ho Chi Minh City University of Education, HCM City, Việt Nam </p>
            <div class="map-container" style="width: 100%; height: 200px; margin-top: 15px;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.6505970936805!2d106.67959617518328!3d10.761388459470599!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1b8a072901%3A0x2fb4502ebd044212!2sHo%20Chi%20Minh%20City%20University%20of%20Education!5e0!3m2!1sen!2s!4v1735569780005!5m2!1sen!2s"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="https://www.facebook.com/@HCMUE.VN"> <i class="fab fa-facebook-f"></i> facebook </a>
        </div>

    </div>

    <p class="credit"> &copy; copyright @ <?php echo date('Y'); ?> by <span>No name</span> </p>

</section>
