document.addEventListener('DOMContentLoaded', () => {

    const heading = document.querySelector('h1');
    heading.textContent = 'Selamat Datang di Website Kami';


    const paragraph = document.querySelector('p');
    paragraph.textContent = 'Layanan penitipan barang dan kendaraan terbaik di sini!';


    const button = document.querySelector('button');
    button.addEventListener('click', () => {
        alert('Anda memulai penjelajahan di website ini!');
    });


    const secondHeading = document.querySelector('#second-heading');
    secondHeading.textContent = 'Layanan Penitipan Barang dan Kendaraan';


    const secondImage = document.querySelector('#second-image');
    secondImage.src = 'imgsaran.jpg';


    const contactForm = document.querySelector('#contactForm');
    contactForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = document.querySelector('#name').value;
        const message = document.querySelector('#message').value;
        if (name && message) {
            alert(`Terima kasih, ${name}, pesan Anda telah terkirim!`);
        } else {
            alert('Harap isi semua kolom!');
        }
    });
});

