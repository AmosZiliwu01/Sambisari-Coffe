document.addEventListener("DOMContentLoaded", () => {
    const collapsible = document.querySelector('.collapsible');
    const chatBox = document.getElementById('chatbox');
    const textInput = document.getElementById('textInput');
    const sendButton = document.querySelector('.fa-paper-plane');

    collapsible.addEventListener("click", () => {
        const content = document.querySelector('.content');
        content.style.display = content.style.display === "block" ? "none" : "block";
    });

    sendButton.addEventListener("click", sendMessage);
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
            return "Hello there! What can I do for you?";
        } else if (input === "hi") {
            return "Hi there! What can I do for you?";
        } else if (input === "commands") {
            return "Keywords/Commands: <br/><br/> <strong>menu</strong> - it will show our menu. <br/> <strong>about</strong> - it will show the 'about us'. <br/> <strong>contact</strong>- it will show 'contact info'. <br/> <strong>commands</strong> - it will show 'keyword'. <br/> <strong>how to order</strong> - it will show the instruction. <br/> <strong>location</strong> - it will show our address.";
        } else if (input === "menu") {
            return "Silakan datangi meja kasir untuk mengecek menu.";
            // return "Here's our menu: <br /><br /> Americano - Hot Espresso (12 OZ) - Rp45.000 <br /> Caffe Latte - Steamed Milk (12 OZ) - Rp50.000 <br /> Salted Caramel Espresso (12 OZ) - Rp30.000 <br /> Cafe Mocha Espresso (12 OZ) - Rp25.000 <br /> Spanish Latte Espresso (12 OZ) - Rp15.000 ";
        } else if (input === "about") {
            return "Hi there! <br /><br /> <strong>KapeTann Brewed Coffee</strong> is a coffee shop and retailer in Zambales, Philippines.";
        } else if (input === "contact") {
            return "Here's our contact information: <br /><br /> <strong>Email:</strong> abfiguerrez18@gmail.com <br /> <strong>Phone Number:</strong> 0917 134 1422 <br /> <strong>Messenger:</strong> @kapetanncoffee <br /> <strong>Address:</strong> Laoag, San Marcelino, Zambales ";
        } else if (input === "how to order") {
            return "Hi There! <br /><br /> To order, you can go to our <strong>Menu</strong> section and click the <strong'Add to Cart'></strong> button of your choice. <br /><br /> I hope you understand. Thank you so much!";
        } else if (input === "location") {
            return "Here's our address: <strong>San Marcelino, Zambales 2207 Olongapo, Philippines</strong>";
        } else {
            return "Sorry, I didn't understand that. You can ask for the menu.";
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
    addBotMessage("Hello! How can I help you today? You can ask for the menu.");
});
