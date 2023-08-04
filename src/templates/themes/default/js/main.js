document.addEventListener("DOMContentLoaded", () => {
    const navbarToggle = document.querySelector(".navbar-toggle");
    const navbarMenu = document.getElementById("navbarMenu");
    const navbarLinks = navbarMenu.querySelectorAll("a");
    const overlay = document.getElementById("overlay");

    navbarToggle.addEventListener("click", () => {
        navbarMenu.classList.toggle("active");
        overlay.classList.toggle("active");
        document.body.classList.toggle(
            "noscroll",
            navbarMenu.classList.contains("active")
        );
    });

    const sections = document.querySelectorAll(".content section");

    function handleActiveLink(entries) {
        entries.forEach((entry) => {
            const id = entry.target.id;
            const link = document.querySelector(`#navbarMenu a[href="#${id}"]`);
            if (entry.isIntersecting && link) {
                // Remove active class from all links
                navbarMenu.querySelectorAll("a.active").forEach((activeLink) => {
                    activeLink.classList.remove("active");
                });

                // Add active class to the current link
                link.classList.add("active");
            }
        });
    }

    const observerOptions = {
        threshold: 0.45,
    };

    const observer = new IntersectionObserver(handleActiveLink, observerOptions);

    sections.forEach((section) => {
        observer.observe(section);
    });

    // Close the mobile menu and overlay when a link is clicked
    navbarLinks.forEach((link) => {
        link.addEventListener("click", () => {
            navbarMenu.classList.remove("active");
            overlay.classList.remove("active");
            document.body.classList.remove("noscroll");
        });
    });

    // Close the mobile menu and overlay when the overlay is clicked
    overlay.addEventListener("click", () => {
        navbarMenu.classList.remove("active");
        overlay.classList.remove("active");
        document.body.classList.remove("noscroll");
    });

    const elem = document.querySelector('.grid');
    imagesLoaded(elem, function() {
        const msnry = new Masonry(elem, {
            itemSelector: '.grid-item',
            columnWidth: '.grid-item',
            percentPosition: true,
            gutter: 20,
            transitionDuration: 0
        });
    });

// Logo Slider

    const slider = tns({
        container: '.platform-logo-slider',
        loop: false,
        slideBy: "page",
        mouseDrag: true,
        swipeAngle: false,
        speed: 400,
        controls: false,
        nav: false,
        items: 2,
        responsive: {
            520: {
                items: 4,
            },

            860: {
                items: 4,
            },

            1000: {
                items: 8,
            }
        }
    });



    const section = document.getElementById('home');
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    const mouse = { x: null, y: null };

    function resizeCanvas() {
        canvas.width = section.clientWidth;
        canvas.height = section.clientHeight;
    }

    resizeCanvas();

    const particles = [];
    const particleCount = 400;

    function Particle() {
        this.x = this.originalX = Math.random() * canvas.width;
        this.y = this.originalY = canvas.height;
        this.speed = Math.random() * 2 + 1;
        this.size = Math.random() * 2 + 1;
        this.opacity = 0;
    }

    Particle.prototype.draw = function() {
        ctx.shadowBlur = 5;
        ctx.shadowColor = "#00A8FF";
        ctx.fillStyle = `rgba(0, 168, 255, ${this.opacity})`;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fill();
    };

    Particle.prototype.update = function() {
        this.y -= this.speed;
        if (this.y < 0) {
            this.y = this.originalY = canvas.height;
            this.x = this.originalX = Math.random() * canvas.width;
            this.opacity = 0;
        }
        this.opacity = 1 - (this.y / canvas.height);
    };

    for (let i = 0; i < particleCount; i++) {
        particles.push(new Particle());
    }

    canvas.addEventListener('mousemove', function(e) {
        mouse.x = e.clientX - canvas.getBoundingClientRect().left;
        mouse.y = e.clientY - canvas.getBoundingClientRect().top;
    });

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(function(p) {
            let dx = mouse.x - p.x;
            let dy = mouse.y - p.y;
            let distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < 150) {
                p.x += dx / 20; // Attract particle towards mouse
                p.y += dy / 20;
            }

            p.update();
            p.draw();
        });
        requestAnimationFrame(animate);
    }

    animate();

    window.addEventListener('resize', function() {
        resizeCanvas();
    });



//     const sectionHome = document.querySelector('.section__home');
//     const canvas = document.getElementById("canvas");
//     const ctx = canvas.getContext("2d");
//     const img = new Image();
//     img.src = "/images/c8-symbol.png";
//     const particles = [];
//     const particleSize = 3;
//     const particleCount = 5000;
//
// // Variables for scaling and positioning the particle image
//     const scale = 0.5; // Change this to your desired scale
//     const imgX = 0;  // X coordinate
//     const imgY = 0;  // Y coordinate
//
//     img.onload = () => {
//         canvas.width = sectionHome.clientWidth;
//         canvas.height = sectionHome.clientHeight;
//
//         const scaledWidth = img.width * scale;
//         const scaledHeight = img.height * scale;
//
//         ctx.drawImage(img, imgX, imgY, scaledWidth, scaledHeight);
//
//         const imageData = ctx.getImageData(imgX, imgY, scaledWidth, scaledHeight).data;
//
//         for (let i = 0; i < particleCount; i++) {
//             const x = Math.floor(Math.random() * scaledWidth) + imgX;
//             const y = Math.floor(Math.random() * scaledHeight) + imgY;
//             const pixelIndex = ((y - imgY) * scaledWidth + (x - imgX)) * 4;
//             particles.push({
//                 x: x,
//                 y: y,
//                 startX: x,
//                 startY: y,
//                 color: `rgba(${imageData[pixelIndex]}, ${imageData[pixelIndex + 1]}, ${imageData[pixelIndex + 2]}, ${imageData[pixelIndex + 3] / 255})`,
//                 velocity: { x: 0, y: 0 },
//                 offset: Math.random() * Math.PI * 2
//             });
//         }
//         animate();
//     };
//
//     let mouse = { x: null, y: null };
//
//     canvas.addEventListener("mousemove", (event) => {
//         const rect = canvas.getBoundingClientRect();
//         mouse.x = event.clientX - rect.left - window.scrollX;
//         mouse.y = event.clientY - rect.top - window.scrollY;
//     });
//
//     canvas.addEventListener("mouseleave", () => {
//         mouse.x = null;
//         mouse.y = null;
//     });
//
//     function lerp(start, end, amt) {
//         return (1 - amt) * start + amt * end;
//     }
//
//     function animate() {
//         ctx.clearRect(0, 0, canvas.width, canvas.height);
//
//         particles.forEach((particle) => {
//             const particleLeft = particle.x - particleSize / 2;
//             const particleRight = particle.x + particleSize / 2;
//             const particleTop = particle.y - particleSize / 2;
//             const particleBottom = particle.y + particleSize / 2;
//
//             ctx.shadowColor = particle.color;
//
//             const oscillation = Math.sin(particle.offset + Date.now() * 0.001) * 3;
//
//             if (mouse.x) {
//                 const dx = particle.x - mouse.x;
//                 const dy = particle.y - mouse.y;
//                 const distance = Math.sqrt(dx * dx + dy * dy);
//                 if (distance < 200) {
//                     const forceDirectionX = dx / distance;
//                     const forceDirectionY = dy / distance;
//                     const maxDistance = 300;
//                     const force = ((maxDistance - distance) / maxDistance) * 0.8;
//                     const directionX = forceDirectionX * force;
//                     const directionY = forceDirectionY * force;
//                     particle.velocity.x -= directionX;
//                     particle.velocity.y -= directionY;
//                 }
//             } else {
//                 particle.x = lerp(particle.x, particle.startX + oscillation, 0.05);
//                 particle.y = lerp(particle.y, particle.startY + oscillation, 0.05);
//                 particle.velocity.x = 0;
//                 particle.velocity.y = 0;
//             }
//
//             particle.x += particle.velocity.x;
//             particle.y += particle.velocity.y;
//
//             particle.velocity.x *= 0.99;
//             particle.velocity.y *= 0.99;
//
//             ctx.fillStyle = particle.color;
//             ctx.fillRect(
//                 particle.x - particleSize / 2,
//                 particle.y - particleSize / 2,
//                 particleSize,
//                 particleSize
//             );
//         });
//
//         requestAnimationFrame(animate);
//     }


});