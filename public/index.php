<?php include "../templates/header.php"; ?>

<div class="container-fluid bg-image">
    <div class="row overlay d-flex align-items-center">
        
        <!-- Left Section: Header Content -->
        <div class="col-md-6 text-center text-md-start px-5">
            <header>
                <h1 class="display-4 fw-bold">Welcome to Our Landing Page</h1>
                <p class="lead">Your perfect solution for business growth</p>
                <a href="#contact" class="btn btn-warning btn-lg">Get Started</a>
            </header>
        </div>

        <!-- Right Section: Contact Form -->
        <div class="col-md-4 offset-md-1">
            <section id="contact" class="bg-light p-4 rounded shadow">
                <h2 class="mb-3 text-center text-primary">Contact Us</h2>
                <form  id ="contactForm"> <!-- For Ajax we want to remove action and method attribute-->
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" >
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" >
                    </div>
                    <div class="mb-3">
                        <textarea name="message" class="form-control" placeholder="Your Message" rows="4" ></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
                <div id="responseMessage" ></div>
            </section>
        </div>
    </div>
</div>

    
<?php include "../templates/footer.php"; ?>
