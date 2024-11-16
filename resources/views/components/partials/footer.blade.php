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
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('signup') }}">Register</a>
            <a href="{{ route('borrow') }}" class="{{ request()->routeIs(patterns: 'borrow') ? 'chosen' : '' }}">Borrow
                Status</a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
            <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
            <p> <i class="fas fa-envelope"></i> tr.a.nt.a.i.sgr.pkts.mail@gmail.com </p>
            <p> <i class="fas fa-map-marker-alt"></i> HCM City, Việt Nam </p>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
        </div>

    </div>

    <p class="credit"> &copy; copyright @ <?php echo date('Y'); ?> by <span>No name</span> </p>

</section>
