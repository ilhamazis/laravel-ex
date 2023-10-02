<x-landing-layout>
    <section class="hero hero__home-page" style="background-image: url({{ asset('/assets/images/hero_home.jpeg') }})">
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
            <form class="hero__form">
                <div class="hero__input-row">
                    <div class="hero__input-group">
                        <div class="hero__input-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 21L15 15M17 10C17 10.9193 16.8189 11.8295 16.4672 12.6788C16.1154 13.5281 15.5998 14.2997 14.9497 14.9497C14.2997 15.5998 13.5281 16.1154 12.6788 16.4672C11.8295 16.8189 10.9193 17 10 17C9.08075 17 8.1705 16.8189 7.32122 16.4672C6.47194 16.1154 5.70026 15.5998 5.05025 14.9497C4.40024 14.2997 3.88463 13.5281 3.53284 12.6788C3.18106 11.8295 3 10.9193 3 10C3 8.14348 3.7375 6.36301 5.05025 5.05025C6.36301 3.7375 8.14348 3 10 3C11.8565 3 13.637 3.7375 14.9497 5.05025C16.2625 6.36301 17 8.14348 17 10Z"
                                    stroke="#6F6F6F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <input type="text" class="hero__input" placeholder="Cari Pekerjaanmu..."/>
                    </div>

                    <div class="hero__input-group">
                        <div class="hero__input-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 13.255C18.1405 14.4112 15.0844 15.0038 12 15C8.817 15 5.78 14.38 3 13.255M16 6V4C16 3.46957 15.7893 2.96086 15.4142 2.58579C15.0391 2.21071 14.5304 2 14 2H10C9.46957 2 8.96086 2.21071 8.58579 2.58579C8.21071 2.96086 8 3.46957 8 4V6M12 12H12.01M5 20H19C19.5304 20 20.0391 19.7893 20.4142 19.4142C20.7893 19.0391 21 18.5304 21 18V8C21 7.46957 20.7893 6.96086 20.4142 6.58579C20.0391 6.21071 19.5304 6 19 6H5C4.46957 6 3.96086 6.21071 3.58579 6.58579C3.21071 6.96086 3 7.46957 3 8V18C3 18.5304 3.21071 19.0391 3.58579 19.4142C3.96086 19.7893 4.46957 20 5 20Z"
                                    stroke="#6F6F6F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <select class="hero__select">
                            <option selected disabled>Tipe Pekerjaan</option>
                        </select>
                    </div>

                    <div class="hero__input-group">
                        <div class="hero__input-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17 20H22V18C22 17.3765 21.8057 16.7686 21.4441 16.2606C21.0826 15.7527 20.5718 15.37 19.9827 15.1658C19.3937 14.9615 18.7556 14.9459 18.1573 15.121C17.5589 15.2962 17.03 15.6534 16.644 16.143M17 20H7M17 20V18C17 17.344 16.874 16.717 16.644 16.143M16.644 16.143C16.2726 15.215 15.6318 14.4195 14.804 13.8591C13.9762 13.2988 12.9996 12.9993 12 12.9993C11.0004 12.9993 10.0238 13.2988 9.196 13.8591C8.36825 14.4195 7.72736 15.215 7.356 16.143M7 20H2V18C2.00005 17.3765 2.19434 16.7686 2.55586 16.2606C2.91739 15.7527 3.42819 15.37 4.01725 15.1658C4.60632 14.9615 5.24438 14.9459 5.84274 15.121C6.4411 15.2962 6.97003 15.6534 7.356 16.143M7 20V18C7 17.344 7.126 16.717 7.356 16.143M15 7C15 7.79565 14.6839 8.55871 14.1213 9.12132C13.5587 9.68393 12.7956 10 12 10C11.2044 10 10.4413 9.68393 9.87868 9.12132C9.31607 8.55871 9 7.79565 9 7C9 6.20435 9.31607 5.44129 9.87868 4.87868C10.4413 4.31607 11.2044 4 12 4C12.7956 4 13.5587 4.31607 14.1213 4.87868C14.6839 5.44129 15 6.20435 15 7ZM21 10C21 10.5304 20.7893 11.0391 20.4142 11.4142C20.0391 11.7893 19.5304 12 19 12C18.4696 12 17.9609 11.7893 17.5858 11.4142C17.2107 11.0391 17 10.5304 17 10C17 9.46957 17.2107 8.96086 17.5858 8.58579C17.9609 8.21071 18.4696 8 19 8C19.5304 8 20.0391 8.21071 20.4142 8.58579C20.7893 8.96086 21 9.46957 21 10ZM7 10C7 10.5304 6.78929 11.0391 6.41421 11.4142C6.03914 11.7893 5.53043 12 5 12C4.46957 12 3.96086 11.7893 3.58579 11.4142C3.21071 11.0391 3 10.5304 3 10C3 9.46957 3.21071 8.96086 3.58579 8.58579C3.96086 8.21071 4.46957 8 5 8C5.53043 8 6.03914 8.21071 6.41421 8.58579C6.78929 8.96086 7 9.46957 7 10Z"
                                    stroke="#6F6F6F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <select class="hero__select">
                            <option selected disabled>Posisi Pekerjaan</option>
                        </select>
                    </div>
                </div>

                <button class="button button__md button__primary" type="submit">Cari Sekarang</button>
            </form>
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
                <x-link href="#" class="button button__md button__ghost">
                    <span>Explore Sekarang!</span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18ZM13.707 9.293L10.707 6.293C10.5184 6.11084 10.2658 6.01005 10.0036 6.01233C9.7414 6.0146 9.49059 6.11977 9.30518 6.30518C9.11977 6.49059 9.0146 6.7414 9.01233 7.0036C9.01005 7.2658 9.11084 7.5184 9.293 7.707L10.586 9H7C6.73478 9 6.48043 9.10536 6.29289 9.29289C6.10536 9.48043 6 9.73478 6 10C6 10.2652 6.10536 10.5196 6.29289 10.7071C6.48043 10.8946 6.73478 11 7 11H10.586L9.293 12.293C9.19749 12.3852 9.12131 12.4956 9.0689 12.6176C9.01649 12.7396 8.9889 12.8708 8.98775 13.0036C8.9866 13.1364 9.0119 13.2681 9.06218 13.391C9.11246 13.5139 9.18671 13.6255 9.28061 13.7194C9.3745 13.8133 9.48615 13.8875 9.60905 13.9378C9.73194 13.9881 9.86362 14.0134 9.9964 14.0123C10.1292 14.0111 10.2604 13.9835 10.3824 13.9311C10.5044 13.8787 10.6148 13.8025 10.707 13.707L13.707 10.707C13.8945 10.5195 13.9998 10.2652 13.9998 10C13.9998 9.73484 13.8945 9.48053 13.707 9.293Z"
                              fill="#3955A4"/>
                    </svg>
                </x-link>
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
                <h4 class="home__statistic-count">450+</h4>
                <p class="home__statistic-desc">Karyawan</p>
            </div>
            <div class="home__statistic-item">
                <h4 class="home__statistic-count">450+</h4>
                <p class="home__statistic-desc">Karyawan</p>
            </div>
            <div class="home__statistic-item">
                <h4 class="home__statistic-count">450+</h4>
                <p class="home__statistic-desc">Karyawan</p>
            </div>
            <div class="home__statistic-item">
                <h4 class="home__statistic-count">450+</h4>
                <p class="home__statistic-desc">Karyawan</p>
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

    <section id="featured-jobs" class="home__featured splide">
        <h4 class="home__featured-text">FEATURED JOB</h4>

        <div class="home__featured-row">
            <h2 class="home__featured-title">Jelajahi Semua Job yang Tersedia</h2>

            <div class="home__slide-controls">
                <button id="featured-jobs-previous" class="home__slide-button">
                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M21.6666 13.2972C21.6666 13.7085 21.361 14.0484 20.9644 14.1022L20.8541 14.1097L6.57146 14.109L11.7314 19.2478C12.0493 19.5644 12.0505 20.0789 11.7338 20.3969C11.446 20.686 10.9947 20.7131 10.6761 20.4778L10.5848 20.3994L4.03062 13.8734C3.98871 13.8316 3.9523 13.7864 3.9214 13.7387C3.91268 13.7244 3.90379 13.7097 3.89537 13.6947C3.88762 13.6819 3.88062 13.6685 3.87402 13.6551C3.86485 13.6354 3.85588 13.6152 3.84775 13.5945C3.84114 13.5785 3.83562 13.563 3.83058 13.5474C3.82459 13.528 3.81878 13.5074 3.81378 13.4864C3.81006 13.4717 3.80711 13.4576 3.80454 13.4435C3.80093 13.4225 3.79785 13.4007 3.79566 13.3786C3.79376 13.3618 3.79262 13.3452 3.79199 13.3285C3.79183 13.3184 3.79163 13.3078 3.79163 13.2972L3.79203 13.2657C3.79266 13.2497 3.79375 13.2338 3.7953 13.2179L3.79163 13.2972C3.79163 13.2459 3.79638 13.1957 3.80546 13.1471C3.80756 13.1355 3.81007 13.1235 3.81285 13.1117C3.81862 13.0872 3.82529 13.0637 3.83297 13.0406C3.83674 13.0291 3.84114 13.0168 3.84583 13.0047C3.85532 12.9802 3.86564 12.9569 3.877 12.9342C3.88227 12.9235 3.88818 12.9124 3.89436 12.9013C3.90452 12.8833 3.91498 12.8661 3.92604 12.8494C3.93384 12.8376 3.94248 12.8252 3.95151 12.8131L3.95854 12.8038C3.98043 12.7752 4.00418 12.7481 4.0296 12.7226L4.03057 12.7219L10.5847 6.1948C10.9027 5.87815 11.4171 5.87922 11.7338 6.19717C12.0216 6.48623 12.0469 6.93767 11.8103 7.25526L11.7314 7.34622L6.57363 12.484L20.8541 12.4847C21.3029 12.4847 21.6666 12.8484 21.6666 13.2972Z"
                            fill="#1E2532"/>
                    </svg>
                </button>

                <button id="featured-jobs-next" class="home__slide-button">
                    <svg width="26" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.6665 13.2972C4.6665 13.7085 4.97217 14.0484 5.36875 14.1022L5.479 14.1097L19.7617 14.109L14.6018 19.2478C14.2838 19.5644 14.2827 20.0789 14.5993 20.3969C14.8871 20.686 15.3385 20.7131 15.657 20.4778L15.7483 20.3994L22.3025 13.8734C22.3444 13.8316 22.3808 13.7864 22.4117 13.7387C22.4205 13.7244 22.4293 13.7097 22.4378 13.6947C22.4455 13.6819 22.4525 13.6685 22.4591 13.6551C22.4683 13.6354 22.4772 13.6152 22.4854 13.5945C22.492 13.5785 22.4975 13.563 22.5025 13.5474C22.5085 13.528 22.5144 13.5074 22.5194 13.4864C22.5231 13.4717 22.526 13.4576 22.5286 13.4435C22.5322 13.4225 22.5353 13.4007 22.5375 13.3786C22.5394 13.3618 22.5405 13.3452 22.5411 13.3285C22.5413 13.3184 22.5415 13.3078 22.5415 13.2972L22.5411 13.2657C22.5405 13.2497 22.5394 13.2338 22.5378 13.2179L22.5415 13.2972C22.5415 13.2459 22.5368 13.1957 22.5277 13.1471C22.5256 13.1355 22.5231 13.1235 22.5203 13.1117C22.5145 13.0872 22.5078 13.0637 22.5002 13.0406C22.4964 13.0291 22.492 13.0168 22.4873 13.0047C22.4778 12.9802 22.4675 12.9569 22.4561 12.9342C22.4509 12.9235 22.445 12.9124 22.4388 12.9013C22.4286 12.8833 22.4182 12.8661 22.4071 12.8494C22.3993 12.8376 22.3906 12.8252 22.3816 12.8131L22.3746 12.8038C22.3527 12.7752 22.329 12.7481 22.3035 12.7226L22.3026 12.7219L15.7484 6.1948C15.4304 5.87815 14.916 5.87922 14.5993 6.19717C14.3115 6.48623 14.2862 6.93767 14.5229 7.25526L14.6017 7.34622L19.7595 12.484L5.479 12.4847C5.03027 12.4847 4.6665 12.8484 4.6665 13.2972Z"
                            fill="#1E2532"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="home__slide-container splide__track">
            <ul class="home__slide-row splide__list">
                <li class="card splide__slide">
                    <h4 class="card__title">Business Intellegences (Internship)</h4>
                    <span class="badge badge__outline">Internship</span>
                    <x-link href="#" class="card__link button button__md button__primary">
                        See Detail
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M9.83438 4.23423C9.9844 4.08425 10.1878 4 10.4 4C10.6121 4 10.8156 4.08425 10.9656 4.23423L14.1656 7.43423C14.3156 7.58425 14.3998 7.7877 14.3998 7.99983C14.3998 8.21196 14.3156 8.41541 14.1656 8.56543L10.9656 11.7654C10.8147 11.9112 10.6126 11.9918 10.4029 11.99C10.1931 11.9881 9.99245 11.904 9.84412 11.7557C9.69579 11.6074 9.61166 11.4067 9.60984 11.1969C9.60801 10.9872 9.68865 10.7851 9.83438 10.6342L11.6688 8.79983H2.39998C2.1878 8.79983 1.98432 8.71554 1.83429 8.56551C1.68426 8.41549 1.59998 8.212 1.59998 7.99983C1.59998 7.78766 1.68426 7.58417 1.83429 7.43414C1.98432 7.28411 2.1878 7.19983 2.39998 7.19983H11.6688L9.83438 5.36543C9.6844 5.21541 9.60015 5.01196 9.60015 4.79983C9.60015 4.5877 9.6844 4.38425 9.83438 4.23423Z"
                                  fill="white"/>
                        </svg>
                    </x-link>
                </li>
                <li class="card splide__slide">
                    <h4 class="card__title">Internal Communication Graphic Designer Freelance</h4>
                    <span class="badge badge__outline">Freelance</span>
                    <x-link href="#" class="card__link button button__md button__primary">
                        See Detail
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M9.83438 4.23423C9.9844 4.08425 10.1878 4 10.4 4C10.6121 4 10.8156 4.08425 10.9656 4.23423L14.1656 7.43423C14.3156 7.58425 14.3998 7.7877 14.3998 7.99983C14.3998 8.21196 14.3156 8.41541 14.1656 8.56543L10.9656 11.7654C10.8147 11.9112 10.6126 11.9918 10.4029 11.99C10.1931 11.9881 9.99245 11.904 9.84412 11.7557C9.69579 11.6074 9.61166 11.4067 9.60984 11.1969C9.60801 10.9872 9.68865 10.7851 9.83438 10.6342L11.6688 8.79983H2.39998C2.1878 8.79983 1.98432 8.71554 1.83429 8.56551C1.68426 8.41549 1.59998 8.212 1.59998 7.99983C1.59998 7.78766 1.68426 7.58417 1.83429 7.43414C1.98432 7.28411 2.1878 7.19983 2.39998 7.19983H11.6688L9.83438 5.36543C9.6844 5.21541 9.60015 5.01196 9.60015 4.79983C9.60015 4.5877 9.6844 4.38425 9.83438 4.23423Z"
                                  fill="white"/>
                        </svg>
                    </x-link>
                </li>
                <li class="card splide__slide">
                    <h4 class="card__title">Senior Software Engineer (Backend)</h4>
                    <span class="badge badge__outline">Fulltime</span>
                    <x-link href="#" class="card__link button button__md button__primary">
                        See Detail
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M9.83438 4.23423C9.9844 4.08425 10.1878 4 10.4 4C10.6121 4 10.8156 4.08425 10.9656 4.23423L14.1656 7.43423C14.3156 7.58425 14.3998 7.7877 14.3998 7.99983C14.3998 8.21196 14.3156 8.41541 14.1656 8.56543L10.9656 11.7654C10.8147 11.9112 10.6126 11.9918 10.4029 11.99C10.1931 11.9881 9.99245 11.904 9.84412 11.7557C9.69579 11.6074 9.61166 11.4067 9.60984 11.1969C9.60801 10.9872 9.68865 10.7851 9.83438 10.6342L11.6688 8.79983H2.39998C2.1878 8.79983 1.98432 8.71554 1.83429 8.56551C1.68426 8.41549 1.59998 8.212 1.59998 7.99983C1.59998 7.78766 1.68426 7.58417 1.83429 7.43414C1.98432 7.28411 2.1878 7.19983 2.39998 7.19983H11.6688L9.83438 5.36543C9.6844 5.21541 9.60015 5.01196 9.60015 4.79983C9.60015 4.5877 9.6844 4.38425 9.83438 4.23423Z"
                                  fill="white"/>
                        </svg>
                    </x-link>
                </li>
                <li class="card splide__slide">
                    <h4 class="card__title">Business Intellegences (Internship)</h4>
                    <span class="badge badge__outline">Internship</span>
                    <x-link href="#" class="card__link button button__md button__primary">
                        See Detail
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M9.83438 4.23423C9.9844 4.08425 10.1878 4 10.4 4C10.6121 4 10.8156 4.08425 10.9656 4.23423L14.1656 7.43423C14.3156 7.58425 14.3998 7.7877 14.3998 7.99983C14.3998 8.21196 14.3156 8.41541 14.1656 8.56543L10.9656 11.7654C10.8147 11.9112 10.6126 11.9918 10.4029 11.99C10.1931 11.9881 9.99245 11.904 9.84412 11.7557C9.69579 11.6074 9.61166 11.4067 9.60984 11.1969C9.60801 10.9872 9.68865 10.7851 9.83438 10.6342L11.6688 8.79983H2.39998C2.1878 8.79983 1.98432 8.71554 1.83429 8.56551C1.68426 8.41549 1.59998 8.212 1.59998 7.99983C1.59998 7.78766 1.68426 7.58417 1.83429 7.43414C1.98432 7.28411 2.1878 7.19983 2.39998 7.19983H11.6688L9.83438 5.36543C9.6844 5.21541 9.60015 5.01196 9.60015 4.79983C9.60015 4.5877 9.6844 4.38425 9.83438 4.23423Z"
                                  fill="white"/>
                        </svg>
                    </x-link>
                </li>
                <li class="card splide__slide">
                    <h4 class="card__title">Internal Communication Graphic Designer Freelance</h4>
                    <span class="badge badge__outline">Freelance</span>
                    <x-link href="#" class="card__link button button__md button__primary">
                        See Detail
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M9.83438 4.23423C9.9844 4.08425 10.1878 4 10.4 4C10.6121 4 10.8156 4.08425 10.9656 4.23423L14.1656 7.43423C14.3156 7.58425 14.3998 7.7877 14.3998 7.99983C14.3998 8.21196 14.3156 8.41541 14.1656 8.56543L10.9656 11.7654C10.8147 11.9112 10.6126 11.9918 10.4029 11.99C10.1931 11.9881 9.99245 11.904 9.84412 11.7557C9.69579 11.6074 9.61166 11.4067 9.60984 11.1969C9.60801 10.9872 9.68865 10.7851 9.83438 10.6342L11.6688 8.79983H2.39998C2.1878 8.79983 1.98432 8.71554 1.83429 8.56551C1.68426 8.41549 1.59998 8.212 1.59998 7.99983C1.59998 7.78766 1.68426 7.58417 1.83429 7.43414C1.98432 7.28411 2.1878 7.19983 2.39998 7.19983H11.6688L9.83438 5.36543C9.6844 5.21541 9.60015 5.01196 9.60015 4.79983C9.60015 4.5877 9.6844 4.38425 9.83438 4.23423Z"
                                  fill="white"/>
                        </svg>
                    </x-link>
                </li>
            </ul>
        </div>

        <div class="home__featured-cta">
            <x-link href="{{ route('jobs') }}" class="button button__md button__outline">Explore Sekarang!</x-link>
        </div>
    </section>

    <x-landing.cta/>

    <x-landing.footer/>

    @section('styles')
        <link rel="stylesheet" href="{{ asset('/splide-4.1.3/splide.min.css') }}">
    @endsection

    @section('scripts')
        <script type="text/javascript" src="{{ asset('/splide-4.1.3/splide.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let featuredSlide = new Splide('#featured-jobs', {
                    arrows: false,
                    drag: true,
                    gap: '1.5rem',
                    pagination: false,
                    perPage: 3,
                    breakpoints: {
                        1024: {
                            perPage: 1,
                        }
                    }
                }).mount();

                document.getElementById('featured-jobs-previous').onclick = () => featuredSlide.go('-1');
                document.getElementById('featured-jobs-next').onclick = () => featuredSlide.go('+1');
            });
        </script>
    @endsection
</x-landing-layout>