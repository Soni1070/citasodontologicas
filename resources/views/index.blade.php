<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sistema de gestión de citas odontológicas</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">clinicamuelitas@muelitas.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+57 5589 5556</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="{{ route('public.home') }}" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">Muelitas SAS</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Inicio<br></a></li>
            <li><a href="#about">Acerca de</a></li>
            <li><a href="#services">Tratamientos</a></li>
            <li><a href="#faq">Preguntas frecuentes</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

       @guest
    <a class="cta-btn d-none d-sm-block" href="{{ route('login') }}">
        Ingresar
    </a>
@else
    <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="cta-btn d-none d-sm-block">
            Cerrar sesión
        </button>
    </form>
@endguest

      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <img src="{{ asset('assets/img/main-dental.jpg') }}" alt="" class="hero-img" data-aos="zoom-out" data-aos-delay="100">

      <div class="container position-relative">

        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
          <h2>BIENVENIDO A MUELITAS SAS</h2>
          <p>La mejor solución para la gestión de citas odontológicas</p>
        </div><!-- End Welcome -->

        <div class="content row gy-4">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
              <h3>Reserva tu cita odontológica</h3>
              <div class="text-center">
                <a href="{{ route('login') }}" class="more-btn"><span>Reservar ahora</span> <i class="bi bi-chevron-right"></i></a>
              </div>
            </div>
          </div><!-- End Why Box -->

          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="d-flex flex-column justify-content-center">
              <div class="row gy-4">

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                    <i class="bi bi-clipboard-data"></i>
                    <h4>¡Quiénes somos?</h4>
                    <p>Somos una clínica odontológica dedicada a brindar servicios de calidad con enfoque en la salud bucal de nuestros pacientes.</p>
                  </div>
                </div><!-- End Icon Box -->

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                    <i class="bi bi-gem"></i>
                    <h4>Misión</h4>
                    <p>Brindar una atención de excelencia, con calidad y profesionales altamente capacitados, apoyados con tecnología de punta y material de primera.</p>
                  </div>
                </div><!-- End Icon Box -->

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                    <i class="bi bi-inboxes"></i>
                    <h4>Visión</h4>
                    <p>Ser la clínica odontológica líder en el área de salud bucal, reconocida por la calidad de nuestros servicios y el bienestar de sus pacientes.</p>
                  </div>
                </div><!-- End Icon Box -->

              </div>
            </div>
          </div>
        </div><!-- End  Content-->

      </div>

    </section><!-- /End Hero Section -->


    <!-- Start About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4 gx-5">

          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
            <img src="{{ asset('assets/img/about-dental.jpg') }}" class="img-fluid" alt="" data-aos="fade-up" data-aos-delay="100">
          </div>

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <h3>Acerca de nosotros</h3>
            <p>
              Muelitas SAS es una clínica odontológica conformada por un grupo de profesionales especializados en el cuidado de la salud bucal, ofreciendo alternativas con tecnología de punta para garantizar la calidad de nuestro servicio.
            </p>
            <ul>
              <li>
                <i class="fa-solid fa-vial-circle-check"></i>
                <div>
                  <h5>Nuestra historia</h5>
                  <p>La clínica Muelitas SAS fue fundada en 2010 con el objetivo de ofrecer servicios odontológicos de calidad a la comunidad local.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-pump-medical"></i>
                <div>
                  <h5>Logros y certificaciones</h5>
                  <p>La clínica ha obtenido certificaciones de calidad en servicios odontológicos ISO9000 /ASN2030 y ha sido un referente por su excelencia en atención al paciente.</p>
                </div>
              </li>
            </ul>
          </div>

        </div>

      </div>

    </section><!-- /End About Section -->

        <!-- Start Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tratamientos</h2>
        <p>Ofrecemos una amplia gama de tratamientos dentales especializados para satisfacer las necesidades de cada paciente.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="fas fa-smile-beam"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Diseño de sonrisa</h3>
              </a>
              <p>El diseño de sonrisa es un tratamiento estético personalizado que busca armonizar la apariencia de los dientes y la sonrisa del paciente.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-star"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Blanqueamiento dental</h3>
              </a>
              <p>El blanqueamiento dental es un tratamiento estético no invasivo que permite aclarar el color de los dientes mediante el uso de productos blanqueadores.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-tooth"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Ortodoncia</h3>
              </a>
              <p>En nuestra clínica ofrecemos tratamientos de ortodoncia modernos y personalizados para corregir problemas de alineación dental y mejorar la función masticatoria.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-screwdriver-wrench"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Implantes dentales</h3>
              </a>
              <p>Los implantes dentales son una solución permanente para reemplazar dientes perdidos, ofreciendo una estética natural y funcionalidad óptima.</p>
              <a href="#" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-shield-alt"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Odontología preventiva</h3>
              </a>
              <p>La odontología preventiva se enfoca en mantener la salud bucal mediante la prevención de enfermedades dentales y la promoción de hábitos saludables.</p>
              <a href="#" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-dna"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Odontología restauradora</h3>
              </a>
              <p>La odontología restauradora se enfoca en la reconstrucción y restauración de dientes dañados o perdidos mediante técnicas como coronas, puentes y empastes.</p>
              <a href="#" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /End Services Section -->

    
    <!-- Start Faq Section -->
    <section id="faq" class="faq section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Preguntas frecuentes</h2>
        <p>Encuentra respuestas a las preguntas más comunes sobre nuestros servicios odontológicos.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

              <div class="faq-item">
                <h3>¿Qué servicios odontológicos ofrecen?</h3>
                <div class="faq-content">
                  <p>Ofrecemos una amplia gama de tratamientos dentales especializados y personalizados para todas las edades y necesidades de nuestros pacientes.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>¿Cuál es el horario de atención?</h3>
                <div class="faq-content">
                  <p>Nuestro horario de atención es de lunes a viernes de 8:00 a 18:00 horas, los sábados de 8:00 a 12:00 horas y el domingo no tenemos servicio.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>¿Qué debo hacer si tengo un problema dental?</h3>
                <div class="faq-content">
                  <p>Si tienes un problema dental, te recomendamos contactarnos lo antes posible para agendar una cita. Nuestro equipo de odontólogos están listos para atenderte con profesionalismo y cuidado.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>¿Cómo puedo programar una cita?</h3>
                <div class="faq-content">
                  <p>Puedes programar una cita llamando a nuestro número de teléfono o visitando nuestra página web. Nuestro equipo te ayudará a encontrar la mejor hora disponible para tu consulta odontológica.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>¿Cómo puedo cancelar una cita?</h3>
                <div class="faq-content">
                  <p>Para cancelar una cita, por favor llámanos al menos 24 horas antes de la hora programada. Puedes contactarnos a través de nuestro número telefónico o mediante nuestra página web.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>¿Qué debo llevar a mi cita odontológica?</h3>
                <div class="faq-content">
                  <p>Te recomendamos llevar tu documento de identidad, tu tarjeta de salud y cualquier información relevante sobre tu historial médico o dental. Si tienes radiografías o exámenes previos, también es útil llevarlos.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /End Faq Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Clinica Muelitas</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Calle Palmares 14 Norte</p>
            <p>Bogotá, Colombia</p>
            <p class="mt-3"><strong>Teléfono:</strong> <span>+57 5589 5556</span></p>
            <p><strong>Correo:</strong> <span>clinicamuelitas@muelitas.com</span></p>
          </div>

        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Enlaces</h4>
          <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Terminos del servicio</a></li>
            <li><a href="#">Politica de privacidad</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Hic solutasetp</h4>
          <ul>
            <li><a href="#">Molestiae accusamus iure</a></li>
            <li><a href="#">Excepturi dignissimos</a></li>
            <li><a href="#">Suscipit distinctio</a></li>
            <li><a href="#">Dilecta</a></li>
            <li><a href="#">Sit quas consectetur</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Clinica Muelitas</strong> <span>Todos los derechos reservados</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by Sonia Arcila
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>