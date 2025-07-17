// Dummy JavaScript Code

// 1. Variables
let name = "John Doe";
const age = 30;
var isActive = true;

// 2. Function
function greet(user) {
    return `Hello, ${user}!`;
}

// 3. Array
const fruits = ["Apple", "Banana", "Mango"];
fruits.push("Orange");

// 4. Object
const user = {
    name: "Alice",
    email: "alice@example.com",
    login: function () {
        console.log(`${this.name} has logged in.`);
    }
};

// 5. Loop
for (let i = 0; i < fruits.length; i++) {
    console.log(`Fruit ${i + 1}: ${fruits[i]}`);
}

// 6. Conditional
if (age > 18) {
    console.log(`${name} is an adult.`);
} else {
    console.log(`${name} is a minor.`);
}

// 7. DOM Manipulation (if in browser)
document.addEventListener("DOMContentLoaded", () => {
    const heading = document.createElement("h1");
    heading.textContent = greet(user.name);
    document.
