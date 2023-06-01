<!DOCTYPE html>
<html>

<head>
    <title>Package Deals - Batanes Island</title>
    <style>
        /* CSS styles */

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f1f1f1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .form-container {
            flex: 1;
            margin-right: 20px;
        }

        .image-container {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        h1 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            color: #555;
        }

        input,
        select {
            padding: 8px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        select {
            width: 200px;
        }

        input[type="submit"] {
            background-color: #CBB279;
            color: #fff;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #867070;
        }

        .success-msg {
            margin-top: 10px;
            color: green;
        }

        .package-details {
            display: none;
            margin-top: 10px;
        }

        .show-details {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Package Deals - Batanes Island</h1>
            <form action="bookpackage.php" method="post">
                <label>Name:</label>
                <input type="text" name="name" required />
                <label>Email:</label>
                <input type="email" name="email" required />
                <label>Package Deal:</label>
                <select name="package" id="package-select" required>
                    <option value="">--Select a package deal--</option>
                    <option value="Package Deal 1" data-price="1000">Package Deal 1 - $1050</option>
                    <option value="Package Deal 2" data-price="1500">Package Deal 2 - $1500</option>
                    <option value="Package Deal 3" data-price="2000">Package Deal 3 - $2050</option>
                    <option value="Package Deal 4" data-price="2500">Package Deal 4 - $2500</option>
                    <option value="Package Deal 5" data-price="3000">Package Deal 5 - $3000</option>
                </select>
                <br />
                <span class="show-details" id="show-details-link">Show Details</span>
                <div class="package-details" id="package-details"></div>
                <br />
                <input type="submit" value="Book" />
            </form>
        </div>
        <div class="image-container">
            <img src="https://www.journeyera.com/wp-content/uploads/2018/01/siargao-island-pictures-photo-gallery-01678-768x512.jpg.webp"
                style="width: 100%;">
        </div>
    </div>

    <script>
        // JavaScript code

        // Package details and prices
        const packageDetails = {
            "Package Deal 1": [
                { item: "Hotel Accommodation", price: 200 },
                { item: "Meals", price: 100 },
                { item: "Roundtrip Airfare", price: 700 },
                { item: "Island Tours", price: 50 },
            ],
            "Package Deal 2": [
                { item: "Hotel Accommodation", price: 300 },
                { item: "Meals", price: 150 },
                { item: "Roundtrip Airfare", price: 900 },
                { item: "Island Tours", price: 100 },
                { item: "Boat Excursions", price: 50 },
            ],
            "Package Deal 3": [
                { item: "Hotel Accommodation", price: 400 },
                { item: "Meals", price: 200 },
                { item: "Roundtrip Airfare", price: 1100 },
                { item: "Island Tours", price: 200 },
                { item: "Boat Excursions", price: 100 },
                { item: "Biking Adventure", price: 50 },
            ],
            "Package Deal 4": [
                { item: "Hotel Accommodation", price: 500 },
                { item: "Meals", price: 250 },
                { item: "Roundtrip Airfare", price: 1300 },
                { item: "Island Tours", price: 300 },
                { item: "Boat Excursions", price: 150 },
                { item: "Biking Adventure", price: 100 },
                { item: "Hiking Experience", price: 50 },
            ],
            "Package Deal 5": [
                { item: "Hotel Accommodation", price: 600 },
                { item: "Meals", price: 300 },
                { item: "Roundtrip Airfare", price: 1500 },
                { item: "Island Tours", price: 400 },
                { item: "Boat Excursions", price: 200 },
                { item: "Biking Adventure", price: 150 },
                { item: "Hiking Experience", price: 100 },
                { item: "Cultural Immersion Activities", price: 50 },
            ],
        };

        // Get DOM elements
        const showDetailsLink = document.getElementById("show-details-link");
        const packageDetailsDiv = document.getElementById("package-details");
        const packageSelect = document.getElementById("package-select");

        // Show package details and price when clicking on "Show Details" link
        showDetailsLink.addEventListener("click", function () {
            const selectedPackage = packageSelect.value;
            const details = packageDetails[selectedPackage];
            if (details) {
                let content = "<strong>Included Items:</strong><br>";
                let totalPrice = 0;
                details.forEach((item) => {
                    content += `- ${item.item} - $${item.price}<br>`;
                    totalPrice += item.price;
                });
                packageDetailsDiv.innerHTML = content;
                packageDetailsDiv.style.display = "block";
                packageDetailsDiv.innerHTML += `<strong>Total Price:</strong> $${totalPrice}`;
            } else {
                packageDetailsDiv.innerHTML = "";
                packageDetailsDiv.style.display = "none";
            }
        });
    </script>
</body>

</html>

<style>
    /* CSS styles */

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f1f1f1;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
    }

    h1 {
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
        color: #555;
    }

    input,
    select {
        padding: 8px;
        margin-top: 5px;
        border: none;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    select {
        width: 200px;
    }

    input[type="submit"] {
        background-color: #CBB279;
        color: #fff;
        padding: 10px 20px;
        margin-top: 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #867070;
    }

    .success-msg {
        margin-top: 10px;
        color: green;
    }

    .package-details {
        display: none;
        margin-top: 10px;
    }

    .show-details {
        cursor: pointer;
        color: blue;
        text-decoration: underline;
    }
</style>
</body>

</html>