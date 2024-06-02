document.addEventListener("DOMContentLoaded", () => {
    const collapsible = document.querySelector('.collapsible');
    const chatBox = document.getElementById('chatbox');
    const textInput = document.getElementById('textInput');
    // const sendButton = document.querySelector('.fa-paper-plane');

    collapsible.addEventListener("click", () => {
        const content = document.querySelector('.content');
        content.style.display = content.style.display === "block" ? "none" : "block";
    });

    // sendButton.addEventListener("click", sendMessage);
    textInput.addEventListener("keypress", (e) => {
        if (e.key === 'Enter') sendMessage();
    });

    async function sendMessage() {
        const userInput = textInput.value.trim();
        if (userInput) {
            addUserMessage(userInput);
            const botResponse = await getBotResponse(userInput);
            addBotMessage(botResponse);
            textInput.value = '';
        }
    }

    function addUserMessage(message) {
        const userMessage = `<p class="userText"><span>${message}</span></p>`;
        chatBox.insertAdjacentHTML('beforeend', userMessage);
    }

    function addBotMessage(message) {
        const botMessage = `<p class="botText"><span>${message}</span></p>`;
        chatBox.insertAdjacentHTML('beforeend', botMessage);
    }

    async function getBotResponse(input) {
        input = input.toLowerCase();
        if (input === "hello") {
            return "Halo! Apa yang bisa saya bantu?";
        } else if (input === "hi") {
            return "Halo! Ada yang bisa saya bantu?";
        } else if (input === "commands") {
            return "Kata Kunci/Perintah: <br/><br/> <strong>menu</strong> - akan menampilkan menu kami. <br/> <strong>tentang</strong> - akan menampilkan informasi 'tentang kami'. <br/> <strong>kontak</strong> - akan menampilkan informasi kontak kami. <br/> <strong>perintah</strong> - akan menampilkan daftar 'perintah'. <br/> <strong>cara memesan</strong> - akan menampilkan instruksi. <br/> <strong>lokasi</strong> - akan menampilkan alamat kami.";
        } else if (input === "menu") {
            return "<strong>Silakan datang ke kasir untuk melihat menu.</strong> <br><br> Mohon maaf saat ini kami masih belum bisa menampilkan menu sesuai website";
            // return "Here's our menu: <br /><br /> Americano - Hot Espresso (12 OZ) - Rp45.000 <br /> Caffe Latte - Steamed Milk (12 OZ) - Rp50.000 <br /> Salted Caramel Espresso (12 OZ) - Rp30.000 <br /> Cafe Mocha Espresso (12 OZ) - Rp25.000 <br /> Spanish Latte Espresso (12 OZ) - Rp15.000 ";
        } else if (input === "about") {
            return "Halo! <br /><br /> <strong>Sambisari Coffee & Space<br></strong> Kedai Kopi\n" +
                "WFC TERASIK DI KALASAN, Coffee | Burger & Space\n" +
                "#sambisaricoffee\n" +
                "Sejak 2018\n<br/><br/>" +
                "<strong>Event | Komunitas | Workshop | Chill\n</strong>" +
                "Open Collaboration\n<br/>" +
                "Temukan Kami\n" +
                "👇👇\n<br/>" +
                "Gang Puntadewa No. 9, Jl. Candi Sambisari, Kadisoko, Purwomartani,, Kalasan, Yogyakarta, Indonesia 55571";
        } else if (input === "contact") {
            return "Berikut informasi kontak kami: <br /><br /> <strong>Email:</strong> abfiguerrez18@gmail.com <br /> <strong>Nomor Telepon:</strong> 0917 134 1422 <br /> <strong>Messenger:</strong> @kapetanncoffee <br /> <strong>Alamat:</strong> Laoag, San Marcelino, Zambales ";
        } else if (input === "how to order") {
            return "Hi there! <br /><br />To place an order, please visit our <a href='/pesanan'>Menu Section</a> and click the button of your choice. Thank you!";
        } else if (input === "location") {
            return "Berikut alamat kami: <a href='https://maps.app.goo.gl/aibViFGqMCrBXkev8'><strong>Jl. Candi Sambisari Blok D, Kadisoko, Purwomartani, Kec. Kalasan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55571</strong></a>";
        } else {
            return "Maaf, saya tidak mengerti. Anda bisa meminta untuk melihat menu.";
        }
    }

    async function fetchMenu() {
        try {
            const response = await fetch('/api/menu');
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            const products = await response.json();
            let menuHTML = "Here's our menu: <br /><br />";
            products.forEach(product => {
                menuHTML += `${product.name} - Rp ${product.price}<br />`;
            });
            return menuHTML;
        } catch (error) {
            console.error('Error fetching the menu:', error);
            return "Error fetching the menu. Please try again later.";
        }
    }

    // Initial bot message
    addBotMessage("Halo! Ada yang bisa saya bantu hari ini? Silahkan lakukan pencarian menggunakan Keywords.");
});
