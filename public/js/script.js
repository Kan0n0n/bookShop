let userBox = document.querySelector(".header .header-2 .user-box");

document.querySelector("#user-btn").onclick = () => {
    userBox.classList.toggle("active");
    navbar.classList.remove("active");
};

let navbar = document.querySelector(".header .header-2 .navbar");

// document.querySelector("#menu-btn").onclick = () => {
//     navbar.classList.toggle("active");
//     userBox.classList.remove("active");
// };

window.onscroll = () => {
    userBox.classList.remove("active");
    navbar.classList.remove("active");

    if (window.scrollY > 60) {
        document.querySelector(".header .header-2").classList.add("active");
    } else {
        document.querySelector(".header .header-2").classList.remove("active");
    }
};

document
    .querySelector(".category-filter h4")
    .addEventListener("click", function () {
        if (document.querySelector(".checkbox-group").classList.contains("active")) {
            document.querySelector(".checkbox-group").setAttribute("class", "checkbox-group");
        }
        else
            document.querySelector(".checkbox-group").setAttribute("class", "checkbox-group active");
    });

document.addEventListener("click", function (e) {
    if (!e.target.closest(".category-filter")) {
        document.querySelector(".checkbox-group").setAttribute("class", "checkbox-group");
    }
});

let typingTimer;
const doneTypingInterval = 500;

function fetchBooks() {
    const searchQuery = document.getElementById("searchInput").value;
    const selectedCategories = Array.from(
        document.querySelectorAll('input[name="category"]:checked')
    ).map((checkbox) => checkbox.value);
    const sortBy = document.getElementById("sortBy").value;
    const per_page = document.getElementById('perPage').value;
    const params = new URLSearchParams();
    if (searchQuery) params.append("search", searchQuery);
    selectedCategories.forEach((cat) => params.append("categories[]", cat));
    if (sortBy) params.append("sort", sortBy);
    if (per_page) params.append('per_page', per_page);

    console.log(params.toString());
    console.log(`/explore/search?${params.toString()}`);

    const container = document.querySelector('.box-container');
    container.innerHTML = '<div class="loading">Loading...</div>';

    fetch(`/explore/search?${params.toString()}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.text();
        })
        .then((html) => {
            container.innerHTML = html;
        })
        .catch((error) => {
            container.innerHTML = '<div class="error">An error occurred while fetching books</div>';
            console.error("Error:", error);
        });
}

document.getElementById("searchInput").addEventListener("keyup", () => {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(fetchBooks, doneTypingInterval);
});

document.getElementById("sortBy").addEventListener("change", fetchBooks);

document.querySelectorAll('input[name="category"]').forEach((checkbox) => {
    checkbox.addEventListener("change", fetchBooks);
});

document.getElementById('perPage').addEventListener('change', fetchBooks);

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById("avatar-img");
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}


function openCart() {
    let cart = document.getElementById('cart');
    if (cart.classList.contains('active')) {
        cart.classList.remove('active');
    }
    else {
        cart.classList.add('active');
    }
}

function showAlert(message, type = 'success') {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

    $('.alert-container').empty();
    $('.alert-container').append(alertHtml);

    setTimeout(() => {
        $('.alert').alert('close');
    }, 3000);
}

