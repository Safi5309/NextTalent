<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TextTalent</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="mrinmoy.css">
  <link rel="stylesheet" href="custom.css">
  <link rel="stylesheet" href="backend.js">
  <link rel="stylesheet" href="footer.css">
</head>

<body>
  <nav>
    <div class="nav__header">
      <div class="nav__logo">
        <a href="#" class="logo">Next<span>Talent</span></a>
      </div>
      <div class="nav__menu__btn" id="menu-btn">
        <i class="ri-menu-line"></i>
      </div>
    </div>
    <ul class="nav__links" id="nav-links">
      <li><a href="#home">Home</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#job">Jobs</a></li>
      <li><a href="#service">Services</a></li>
      <li><a href="#client">Client</a></li>
      <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'company'): ?>
        <li><a href="jobSeekers.php">Job Seekers</a></li>
      <?php endif; ?>
      <?php if (isset($_SESSION['user'])): ?>
        <li class="nav__item">
          <a href="profile.php">
            <img src="<?php echo !empty($_SESSION['user']['picture']) ? $_SESSION['user']['picture'] : 'assets/default-profile.png'; ?>"
              alt="Profile" class="pro-img">
          </a>
        </li>
      <?php else: ?>
        <li><a href="register.html" class="btn">Register</a></li>
        <li><a href="login.html" class="btn">Login</a></li>
      <?php endif; ?>
      




    </ul>
  </nav>
  <header class="section__container header__container" id="home">
    <img src="assets/google.png" alt="header" />
    <img src="assets/twitter.png" alt="header" />
    <img src="assets/amazon.png" alt="header" />
    <img src="assets/figma.png" alt="header" />
    <img src="assets/linkedin.png" alt="header" />
    <img src="assets/microsoft.png" alt="header" />
    <h2>
      <img src="assets/bag.png" alt="bag" />
      No.1 Job Hunt Website
    </h2>
    <h1>Search, Apply &<br />Get Your <span>Dream Job</span></h1>
    <p>
      Your future starts here. Discover countless opportunities, take action
      by applying to jobs that match your skills and aspirations, and
      transform your career.
    </p>
    <div class="header__btns">
      <button class="btn">Browse Jobs</button>
      <a href="#">
        <span><i class="ri-play-fill"></i></span>
        How It Works?
      </a>
    </div>
  </header>
  <section class="steps" id="about">
    <div class="section__container steps__container">
      <h2 class="section__header">
        Get Hired in 4 <span>Quick Easy Steps</span>
      </h2>
      <p class="section__description">
        Follow Our Simple, Step-by-Step Guide to Quickly Land Your Dream Job
        and Start Your New Career Journey.
      </p>
      <div class="steps__grid">
        <div class="steps__card create-account-btn" style="cursor: pointer;">
          <span><i class="ri-user-fill"></i></span>
          <h4>Create an Account</h4>
          <p>
            Sign up with just a few clicks to unlock exclusive access to a
            world of job opportunities and landing your dream job. It's quick,
            easy, and completely free.
          </p>
        </div>

        <div class="steps__card">
          <<a href="searchJobs.php" style="text-decoration: none; color: inherit;">

            <span><i class="ri-search-fill"></i></span>
            <h4>Search Job</h4>
            <p>
              Dive into our job database tailored to match your skills and
              preferences. With our advanced search filters, finding the perfect
              job has never been easier.
            </p>

            </a>

        </div>

        <div class="steps__card upload-cv-btn" style="cursor: pointer;">
          <span><i class="ri-file-paper-fill"></i></span>
          <h4>Upload CV/Resume</h4>
          <p>
            Showcase your experience by uploading your CV or resume. Let
            employers know why you're the perfect candidate for their job
            openings.
          </p>


        </div>

        <div class="steps__card">
          <span><i class="ri-briefcase-fill"></i></span>
          <h4>Get Job</h4>
          <p>
            Take the final step towards your new career. Get ready to embark
            on your professional journey and secure the job you've been
            dreaming of.
          </p>
        </div>
      </div>

    </div>
  </section>

  <section class="section__container explore__container">
    <h2 class="section__header">
      <span>Countless Career Options</span> Are Waiting For You To Explore
    </h2>
    <p class="section__description">
      Discover a World of Exciting Opportunities and Endless Possibilities,
      and Find the Perfect Career Path to Shape Your Future.
    </p>
    <div class="explore__grid">
      <!-- explore jobs -->
      <div class="explore__grid">
        <p id="no-jobs-msg">No job categories found.</p>
      </div>

      <button id="viewAllBtn" style="display: none;" class="btn">View All Categories</button>


  </section>

  <!-- Shoumik -->
  <section class="section__container offer__container" id="service">
    <h2 class="section__header">What We <span>Offer</span></h2>
    <p class="section__description">
      Explore the Benefits and Services We Provide to Enhance Your Job Search
      and Career Success
    </p>
    <div class="offer__grid">
      <div class="offer__card">
        <img src="assets/offer-1.jpg" alt="offer" />
        <div class="offer__details">
          <span>01</span>
          <div>
            <h4>Job Recommendation</h4>
            <p>
              Personalized job matches tailored to your skills and preferences
            </p>
          </div>
        </div>
      </div>
      <div class="offer__card">
        <img src="assets/offer-2.jpg" alt="offer" />
        <div class="offer__details">
          <span>02</span>
          <div>
            <h4>Create & Build Portfolio</h4>
            <p>Showcase your expertise with professional portfolio design</p>
          </div>
        </div>
      </div>
      <div class="offer__card">
        <img src="assets/offer-3.jpg" alt="offer" />
        <div class="offer__details">
          <span>03</span>
          <div>
            <h4>Career Consultation</h4>
            <p>Receive expert advice to navigate your career path</p>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!-- Mrinmoy -->

  <section class="section__container job__container" id="job">
    <h2 class="section__header"><span>Latest & Top</span> Job Openings</h2>
    <p class="section__description">
      Discover Exciting New Opportunities and High-Demand Positions Available
      Now in Top Industries and Companies
    </p>

    <div class="job__grid">
      <div class="job__card">
        <div class="job__card__header">
          <img src="assets/figma.png" alt="job" />
          <div>
            <h5>Figma</h5>
            <h6>USA</h6>
          </div>
        </div>
        <h4>Senior Product Engineer</h4>
        <p>
          Lead the development of innovative product solutions, leveraging
          your expertise in engineering and product management to drive
          success.
        </p>
        <div class="job__card__footer">
          <span>12 Positions</span>
          <span>Full Time</span>
          <span>$1,45,000/Year</span>
        </div>
      </div>
      <div class="job__card">
        <div class="job__card__header">
          <img src="assets/google.png" alt="job" />
          <div>
            <h5>Google</h5>
            <h6>USA</h6>
          </div>
        </div>
        <h4>Project Manager</h4>
        <p>
          Manage project timelines and budgets to ensure successful delivery
          of projects on schedule, while maintaining clear communication with
          stakeholders.
        </p>
        <div class="job__card__footer">
          <span>2 Positions</span>
          <span>Full Time</span>
          <span>$95,000/Year</span>
        </div>
      </div>
      <div class="job__card">
        <div class="job__card__header">
          <img src="assets/linkedin.png" alt="job" />
          <div>
            <h5>LinkedIn</h5>
            <h6>Germany</h6>
          </div>
        </div>
        <h4>Full Stack Developer</h4>
        <p>
          Develop and maintain both front-end and back-end components of web
          applications, utilizing a wide range of programming languages and
          frameworks.
        </p>
        <div class="job__card__footer">
          <span>10 Positions</span>
          <span>Full Time</span>
          <span>$35,000/Year</span>
        </div>
      </div>
      <div class="job__card">
        <div class="job__card__header">
          <img src="assets/amazon.png" alt="job" />
          <div>
            <h5>Amazon</h5>
            <h6>USA</h6>
          </div>
        </div>
        <h4>Front-end Developer</h4>
        <p>
          Design and implement user interfaces using HTML, CSS, and
          JavaScript, collaborating closely with designers and back-end
          developers.
        </p>
        <div class="job__card__footer">
          <span>20 Positions</span>
          <span>Full Time</span>
          <span>$1,01,000/Year</span>
        </div>
      </div>
      <div class="job__card">
        <div class="job__card__header">
          <img src="assets/twitter.png" alt="job" />
          <div>
            <h5>Twitter</h5>
            <h6>USA</h6>
          </div>
        </div>
        <h4>ReactJS Developer</h4>
        <p>
          Specialize in building dynamic and interactive user interfaces using
          the ReactJS library, leveraging your expertise in JavaScript and
          front-end development.
        </p>
        <div class="job__card__footer">
          <span>6 Positions</span>
          <span>Full Time</span>
          <span>$98,000/Year</span>
        </div>
      </div>
      <div class="job__card">
        <div class="job__card__header">
          <img src="assets/microsoft.png" alt="job" />
          <div>
            <h5>Microsoft</h5>
            <h6>USA</h6>
          </div>
        </div>
        <h4>Python Developer</h4>
        <p>
          Develop scalable and efficient backend systems and applications
          using Python, utilizing your proficiency in Python programming and
          software development.
        </p>
        <div class="job__card__footer">
          <span>9 Positions</span>
          <span>Full Time</span>
          <span>$80,000/Year</span>
        </div>
      </div>
    </div>
  </section>

  <section class="section__container client__container" id="client">
    <h2 class="section__header">What Our <span>Client Say</span></h2>
    <p class="section__description">
      Read Testimonials and Success Stories from Our Satisfied Job Seekers and
      Employers to See How We Make a Difference
    </p>

    <div class="swiper">

      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div class="client__card">
            <img src="assets/client-1.jpg" alt="client" />
            <p>
              Searching for a job can be overwhelming, but this platform made
              it simple and efficient. I uploaded my resume, applied to a few
              positions, and soon enough, I was hired! Thank you for helping
              me kickstart my career!
            </p>
            <div class="client__ratings">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
            </div>
            <h4>Sarah Patel</h4>
            <h5>Graphic Designer</h5>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="client__card">
            <img src="assets/client-2.jpg" alt="client" />
            <p>
              As a recent graduate, I was unsure where to start my job search.
              This website guided me through the process step by step. From
              creating my profile to receiving job offers, everything was
              seamless. I'm now happily employed thanks to this platform!
            </p>
            <div class="client__ratings">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-half-fill"></i></span>
            </div>
            <h4>Michael Brown</h4>
            <h5>Recent Graduate</h5>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="client__card">
            <img src="assets/client-3.jpg" alt="client" />
            <p>
              Creating an account was a breeze, and I was amazed by the number
              of job opportunities available. Thanks to this website, I found
              the perfect position that aligned perfectly with my career
              goals.
            </p>
            <div class="client__ratings">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
            </div>
            <h4>David Smith</h4>
            <h5>Software Engineer</h5>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="section__container footer__container">
      <div class="footer__col">
        <div class="footer__logo">
          <a href="#" class="logo">Next<span>Talent</span></a>
        </div>
        <p>
          Our platform is designed to help you find the perfect job and
          achieve your professional dreams.
        </p>
      </div>
      <div class="footer__col">
        <h4>Quick Links</h4>
        <ul class="footer__links">
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Jobs</a></li>
          <li><a href="#">Testimonials</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
      </div>
      <div class="footer__col">
        <h4>Follow Us</h4>
        <ul class="footer__links">
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">LinkedIn</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Youtube</a></li>
        </ul>
      </div>
      <div class="footer__col">
        <h4>Contact Us</h4>
        <ul class="footer__links">
          <li>
            <a href="#">
              <span><i class="ri-phone-fill"></i></span> 000000000
            </a>
          </li>
          <li>
            <a href="#">
              <span><i class="ri-map-pin-2-fill"></i></span> DSC, Ashulia, Dhaka-1120
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer__bar">
      Copyright © 2025 NextTalent. All rights reserved.
    </div>
  </footer>
  <!-- explor jobs -->


  <!-- upload cv form -->
  <form action="cvUpload.php" method="POST" enctype="multipart/form-data" id="cvUploadForm" style="display: none;">
    <input type="file" name="cv" id="cvUploadInput" accept="application/pdf"
      onchange="document.getElementById('cvUploadForm').submit();" />
  </form>

  <!-- account create card navigation -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const isLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;

      const createBtn = document.querySelector(".create-account-btn");
      const uploadCard = document.querySelector(".upload-cv-btn");

      if (createBtn) {
        createBtn.addEventListener("click", () => {
          if (!isLoggedIn) {
            window.location.href = "register.html";
          } else {
            const confirmLogout = confirm(
              "You are already logged in. Do you want to create a new account?");
            if (confirmLogout) {
              window.location.href = "logoutResiter.php";
            }
          }
        });
      }

      if (uploadCard) {
        uploadCard.addEventListener("click", () => {
          if (!isLoggedIn) {
            const confirmLogin = confirm(
              "You must be logged in to upload your CV. Do you want to login now?");
            if (confirmLogin) {
              window.location.href = "login.html";
            }
          } else {
            document.getElementById("cvUploadInput").click();
          }
        });
      }
    });
    document.getElementById("cvUploadInput").click();
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      fetch("explore.php")
        .then(response => response.json())
        .then(data => {
          const container = document.querySelector(".explore__grid");
          const msg = document.getElementById("no-jobs-msg");
          container.innerHTML = "";

          if (data.length === 0) {
            msg.style.display = "block";
          } else {
            msg.style.display = "none";
            data.forEach(item => {
              const card = document.createElement("div");
              card.className = "explore__card";
              card.innerHTML = `
            <span><i class="ri-briefcase-fill"></i></span>
            <h4>${item.title}</h4>
            <p>${item.vacancy} job openings</p>
          `;
              card.onclick = () => {
                window.location.href = `job-category.php?title=${encodeURIComponent(item.title)}`;
              };
              container.appendChild(card);
            });
          }
        });
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      fetch("explore.php")
        .then(response => response.json())
        .then(data => {
          const container = document.getElementById("exploreGrid");
          const msg = document.getElementById("no-jobs-msg");
          const viewAllBtn = document.getElementById("viewAllBtn");

          container.innerHTML = "";

          if (data.length === 0) {
            msg.style.display = "block";
            viewAllBtn.style.display = "none";
          } else {
            msg.style.display = "none";

            data.forEach((item, index) => {
              const card = document.createElement("div");
              card.className = "explore__card";
              card.setAttribute("data-title", item.title);

              if (index >= 8) {
                card.style.display = "none"; // Hide cards beyond the first 8
                card.classList.add("hidden-card");
              }

              card.innerHTML = `
            <span><i class="ri-briefcase-fill"></i></span>
            <h4>${item.title}</h4>
            <p>${item.vacancy} job openings</p>
          `;

              card.addEventListener("click", () => {
                window.location.href = `job-category.php?title=${encodeURIComponent(item.title)}`;
              });

              container.appendChild(card);
            });

            if (data.length > 8) {
              viewAllBtn.style.display = "inline-block";

              viewAllBtn.addEventListener("click", () => {
                document.querySelectorAll(".hidden-card").forEach(card => {
                  card.style.display = "block";
                });
                viewAllBtn.style.display = "none"; // Hide button after click
              });
            }
          }
        });
    });
  </script>


</body>

</html>