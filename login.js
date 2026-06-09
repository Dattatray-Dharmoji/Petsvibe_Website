import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
import { getAuth, GoogleAuthProvider, signInWithPopup, signOut, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-auth.js";

// Your web app's Firebase configuration
const firebaseConfig = {

};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

// Function to sign in with Google
function signInWithGoogle() {
    signInWithPopup(auth, provider)
        .then((result) => {
            const user = result.user;
            console.log("User signed in: ", user);
            updateUIOnLogin(user);

            // Close the modal after successful login
            document.getElementById('modal').style.display = "none";
        })
        .catch((error) => {
            console.error("Error signing in with Google: ", error.message);
        });
}

// Function to update UI after login
function updateUIOnLogin(user) {
    const loginRegisterBtn = document.getElementById('loginRegisterBtn');

    // Change button text to Logout
    loginRegisterBtn.textContent = "Logout";
    loginRegisterBtn.onclick = logout; // Attach logout function to button
}

// Logout function
function logout() {
    signOut(auth).then(() => {
        console.log("User signed out");
        resetUI();
        showLogoutPopup(); // Show the custom logout popup
    }).catch((error) => {
        console.error("Error signing out: ", error);
    });
}

// Function to show the logout popup
function showLogoutPopup() {
    const logoutPopup = document.getElementById('logoutPopup');
    logoutPopup.style.display = "block"; // Show the popup
}

// Close the logout popup when the user clicks on <span> (x) or the close button
document.getElementById('closePopup').onclick = function () {
    document.getElementById('logoutPopup').style.display = "none";
};

document.getElementById('closePopupBtn').onclick = function () {
    document.getElementById('logoutPopup').style.display = "none";
};

// Close the logout popup when clicking outside of it
window.onclick = function (event) {
    const logoutPopup = document.getElementById('logoutPopup');
    if (event.target === logoutPopup) {
        logoutPopup.style.display = "none";
    }
}

// Function to reset UI after logout
function resetUI() {
    const loginRegisterBtn = document.getElementById('loginRegisterBtn');

    // Change button text back to Login/Register
    loginRegisterBtn.textContent = "Login/Register";
    loginRegisterBtn.onclick = function () {
        document.getElementById('modal').style.display = "flex"; // Show the modal again
    };
}

// Function to check user state on page load
function checkUserState() {
    onAuthStateChanged(auth, (user) => {
        if (user) {
            // User is signed in, update UI
            updateUIOnLogin(user);
        } else {
            // No user is signed in, reset UI
            resetUI();
        }
    });
}

// Show the modal when the button is clicked
document.getElementById('loginRegisterBtn').onclick = function () {
    document.getElementById('modal').style.display = "flex";
}

// Close the modal when the close button is clicked
document.getElementById('closeModal').onclick = function () {
    document.getElementById('modal').style.display = "none";
}

// Toggle between login and registration forms
const authForm = document.getElementById('authForm');
document.getElementById('toggleForm').onclick = function () {
    const title = document.getElementById('modalTitle');
    const button = authForm.querySelector('button');
    const paragraph = authForm.querySelector('p');

    if (title.innerText === "Login") {
        title.innerText = "Register";
        button.innerText = "Register";
        paragraph.innerHTML = 'Already have an account? <span id="toggleForm" style="cursor: pointer; color: blue;">Login</span>';
    } else {
        title.innerText = "Login";
        button.innerText = "Login";
        paragraph.innerHTML = 'Don\'t have an account? <span id="toggleForm" style="cursor: pointer; color: blue;">Register</span>';
    }
}

// Add event listener for Google Sign-In
document.getElementById("googleSignInBtn").addEventListener("click", signInWithGoogle);

// Check user state on page load
checkUserState();
