document.addEventListener('DOMContentLoaded', () => {

    const heading = document.querySelector('h1');
    heading.textContent = 'Selamat Datang di Website Kami';


    const paragraph = document.querySelector('p');
    paragraph.textContent = 'Layanan penitipan barang dan kendaraan terbaik di sini!';


    const button = document.querySelector('button');
    button.addEventListener('click', () => {
        alert('Anda memulai penjelajahan di website ini!');
    });

});

