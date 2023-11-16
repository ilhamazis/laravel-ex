<x-landing-layout>
    <section class="hero hero__about-page" style="background-image: url({{ asset('/assets/images/hero_home.jpeg') }})">
        <x-landing.navbar/>

        <div class="hero__content">
            <h1 class="hero__title">
                Bergabunglah dengan SEVIMA untuk Meraih
                <span class="emphasis">Karier Luar Biasa!</span>
            </h1>
            <p class="hero__description">
                Apakah Anda siap mengambil langkah berani dalam karier Anda? SEVIMA mengundang Anda untuk menjelajahi
                peluang luar biasa di dunia profesional kami.
            </p>
        </div>
    </section>

    <section class="home__gallery">
        <div class="home__gallery-container"
             style="background-image: url({{ asset('/assets/images/circle_gallery.svg') }})">
            <div class="home__gallery-header">
                <h4 class="home__gallery-text">GALERI KAMI</h4>
                <h2 class="home__gallery-title">
                    <span class="emphasis">
                        Menjelajahi Suasana SEVIMA:
                    </span>
                    Melihat Lebih Dekat Lingkungan Kerja Inspiratif Kami!
                </h2>
            </div>

            <div class="home__gallery-content">
                <div class="home__gallery-row">
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_2.jpeg') }}" alt="Gallery 2"/>
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_1.jpeg') }}" alt="Gallery 1"/>
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_3.jpeg') }}" alt="Gallery 3"/>
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_4.jpeg') }}" alt="Gallery 4"/>
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_5.jpeg') }}" alt="Gallery 5"/>
                </div>
                <div class="home__gallery-row">
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_6.jpeg') }}" alt="Gallery 6"/>
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_7.jpeg') }}" alt="Gallery 7"/>
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_8.jpeg') }}" alt="Gallery 8"/>
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_9.jpeg') }}" alt="Gallery 9"/>
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_10.jpeg') }}"
                         alt="Gallery 10"/>
                    <img class="home__gallery-item" src="{{ asset('/assets/images/gallery_11.jpeg') }}"
                         alt="Gallery 11"/>
                </div>
            </div>

            <div class="home__gallery-gradient"></div>
        </div>

        <div class="home__statistic">
            <div class="home__statistic-item">
                <h4 class="home__statistic-count">250+</h4>
                <p class="home__statistic-desc">Karyawan</p>
            </div>
            <div class="home__statistic-item">
                <h4 class="home__statistic-count">850+</h4>
                <p class="home__statistic-desc">Klien Universitas</p>
            </div>
            <div class="home__statistic-item">
                <h4 class="home__statistic-count">2,5Jt+</h4>
                <p class="home__statistic-desc">Pengguna Layanan Sevima</p>
            </div>
            <div class="home__statistic-item">
                <h4 class="home__statistic-count">2,5Rb+</h4>
                <p class="home__statistic-desc">Civitas Universitas Bergabung Komunitas</p>
            </div>
        </div>
    </section>

    <section class="home__motto">
        <div class="home__motto-illustration">
            <svg viewBox="0 0 1402 404" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.1"
                      d="M0.5 397.568V398.068H1H58.5924H59.0924V397.568V229.662H63.9484L226.664 397.915L226.811 398.068H227.023H309.609H310.842L309.957 397.209L137.307 229.662H155.304C183.611 229.662 207.775 224.945 227.78 215.49C247.776 206.039 263.246 192.943 274.168 176.197C285.094 159.447 290.549 139.792 290.549 117.254C290.549 94.717 285.095 75.2422 274.166 58.8516C263.244 42.1067 247.774 29.192 227.777 20.1032C207.773 10.6488 183.609 5.93243 155.304 5.93243H1H0.5V6.43243V397.568ZM153.674 181.943H59.0924V54.1946H153.674C180.057 54.1946 199.843 59.797 213.119 70.9184C226.389 82.0347 233.043 97.6378 233.043 117.797C233.043 137.952 226.211 153.738 212.576 165.22C199.299 176.342 179.692 181.943 153.674 181.943ZM341.644 397.568V398.068H342.144H408.973H409.473V397.568V330.205V329.705H408.973H342.144H341.644V330.205V397.568ZM548.021 388.791L548.027 388.793C571.277 398.6 596.88 403.5 624.831 403.5C652.419 403.5 677.841 398.6 701.09 388.793L701.094 388.792C724.697 378.626 745.037 364.645 762.109 346.849L762.113 346.845C779.184 328.687 792.438 307.264 801.877 282.581C811.682 257.529 816.581 230.305 816.581 200.914C816.581 161.366 808.234 126.512 791.525 96.3684C775.184 66.2334 752.664 42.8072 723.968 26.1009C695.267 9.02868 662.034 0.5 624.287 0.5C587.262 0.5 554.212 9.02985 525.15 26.1003C496.453 42.8075 473.932 66.2352 457.59 96.3725C441.245 126.515 433.08 161.186 433.08 200.37C433.08 230.121 437.798 257.345 447.24 282.035L447.242 282.041C457.043 306.723 470.478 328.145 487.548 346.302C504.62 364.46 524.779 378.623 548.021 388.791ZM739.568 279.46L739.565 279.466C728.373 302.57 712.855 320.788 693.013 334.135C673.181 347.113 650.278 353.608 624.287 353.608C598.297 353.608 575.394 347.113 555.562 334.135C536.084 321.152 520.746 303.115 509.552 280.009C498.362 256.91 492.759 230.187 492.759 199.827C492.759 169.829 498.181 143.65 509.008 121.277C520.199 98.8993 535.533 81.5886 555.008 69.3285L555.01 69.3273C574.842 56.7086 597.929 50.3919 624.287 50.3919C650.646 50.3919 673.732 56.7086 693.564 69.3273L693.57 69.3307C713.405 81.5906 728.919 99.0813 740.11 121.821L740.112 121.824C751.3 144.197 756.902 170.193 756.902 199.827C756.902 229.821 751.119 256.362 739.568 279.46ZM840.4 397.568V398.068H840.9H907.729H908.229V397.568V330.205V329.705H907.729H840.9H840.4V330.205V397.568ZM1023.4 397.568V398.068H1023.9H1081.49H1081.99V397.568V54.1946H1213.52H1214.02V53.6946V6.43243V5.93243H1213.52H891.87H891.37V6.43243V53.6946V54.1946H891.87H1023.4V397.568ZM1197.49 397.568V398.068H1197.99H1264.82H1265.32V397.568V330.205V329.705H1264.82H1197.99H1197.49V330.205V397.568ZM1342.91 397.568V398.068H1343.41H1401H1401.5V397.568V6.43243V5.93243H1401H1343.41H1342.91V6.43243V397.568Z"
                      stroke="white"/>
            </svg>
        </div>

        <div class="home__motto-header">
            <h4 class="home__motto-text">CORE VALUE</h4>
            <h2 class="home__motto-title">
                <span class="emphasis">Pilar Nilai SEVIMA:</span>
                Mengarahkan Keunggulan Kami
            </h2>
        </div>

        <div class="home__motto-content">
            <div class="home__motto-row">
                <div class="home__motto-item">
                    <h6 class="home__motto-item-text">RESPONSIBILITY</h6>
                    <h5 class="home__motto-item-title">Menciptakan Dampak Positif dalam Komunitas dan Dunia</h5>
                    <p class="home__motto-item-desc">
                        Kami percaya dalam melakukan pekerjaan kami harus mempunyai peran untuk bertanggungjawab selain
                        kepada shareholder juga kepada masyarakat luas.
                    </p>
                </div>
                <img class="home__motto-image" src="{{ asset('/assets/images/roti_r.jpeg') }}" alt="Roti - R"/>
            </div>

            <div class="home__motto-row">
                <img class="home__motto-image" src="{{ asset('/assets/images/roti_o.jpeg') }}" alt="Roti - O"/>
                <div class="home__motto-item">
                    <h6 class="home__motto-item-text">OPENNESS</h6>
                    <h5 class="home__motto-item-title">Mengapresiasi Keterbukaan: Fondasi Pertumbuhan SEVIMA</h5>
                    <p class="home__motto-item-desc">
                        Kami percaya pemikiran yang terbuka adalah sikap yang tepat untuk mendapatkan lebih banyak ide,
                        fakta, pengetahuan dan kebijaksanaan untuk meningkatkan kinerja kami.
                    </p>
                </div>
            </div>

            <div class="home__motto-row">
                <div class="home__motto-item">
                    <h6 class="home__motto-item-text">TRUSTFULNESS</h6>
                    <h5 class="home__motto-item-title">Tanggung Jawab dan Kepercayaan: Pondasi Keberhasilan di
                        SEVIMA</h5>
                    <p class="home__motto-item-desc">
                        Kami percaya saling percaya satu sama lain, menjadi positif dan berwawasan ke depan
                        menginspirasi semua orang untuk berkontribusi pada pembangunan.
                    </p>
                </div>
                <img class="home__motto-image" src="{{ asset('/assets/images/roti_t.jpeg') }}" alt="Roti - T"/>
            </div>

            <div class="home__motto-row">
                <img class="home__motto-image" src="{{ asset('/assets/images/roti_i.jpeg') }}" alt="Roti - I"/>
                <div class="home__motto-item">
                    <h6 class="home__motto-item-text">INTEGRITY</h6>
                    <h5 class="home__motto-item-title">Integritas Kami: Pilar Utama Keberhasilan di SEVIMA</h5>
                    <p class="home__motto-item-desc">
                        Kami percaya konsistensi dalam tindakan, nilai, prinsip menjadi dasar yang melekat pada diri
                        sendiri sebagai nilai-nilai moral untuk pekerjaan menjadi lebih baik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div style="padding-top: 5rem">
        <x-landing.cta title="Mulailah Petualangan Karir dengan Bergabung di SEVIMA">
            <x-slot:action>
                <x-link href="{{ route('home') }}" class="cta__button button button__lg button__primary">
                    Lamar Sekarang
                </x-link>
            </x-slot:action>
        </x-landing.cta>
    </div>

    <x-landing.footer/>
</x-landing-layout>
