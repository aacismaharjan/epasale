document.addEventListener("DOMContentLoaded", function () {
    const myCart = new Cart();
    var seller__card = document.querySelectorAll(".product__card");

    // Function to handle each seller card
    function handleSellerCard(card) {
        var pId = parseInt(card.getAttribute("data-pid"));
        var pName = card.querySelector(".seller__cardtitle")?.innerText || "New Product";
        var quantityInput = card.querySelector('.qtygroup__input');
        var increaseButton = card.querySelector('.qtygroup__btn--inc');
        var decreaseButton = card.querySelector('.qtygroup__btn--dec');
        var removeButton = card.querySelector(".btn--delete");
        var addToCartButton = card.querySelector(".seller__btn--cart");
        var buyNowButton = card.querySelector(".seller__btn--buy");
        var totalQuantity = parseInt(quantityInput.value);
        var isCart = JSON.parse(card.getAttribute("data-iscart"));

        if(isCart) {
            removeButton.addEventListener("click", function() {
                myCart.deleteProduct(pId);
                card.remove();
            });
        }


        // Add click event listener for the increase button
        increaseButton.addEventListener('click', function () {
            if (totalQuantity < 10) {
                totalQuantity++;
                quantityInput.value = totalQuantity;
            }

            if(isCart) myCart.updateProduct(pId, totalQuantity);
        });

        // Add click event listener for the decrease button
        decreaseButton.addEventListener('click', function () {
            if (totalQuantity > 1) {
                totalQuantity--;
                quantityInput.value = totalQuantity;
            }

            if(isCart) myCart.updateProduct(pId, totalQuantity);
        });

        // Add click event listener for the "Add to Cart" button
        if(addToCartButton != null) {
            addToCartButton.addEventListener('click', function () {
                myCart.addProduct(pId, totalQuantity);
                alert(`${pName} \n${totalQuantity} item(s) added to your cart!`);
            });
        }

        if(buyNowButton != null) {
            buyNowButton.addEventListener('click', function () {
                myCart.addProduct(pId, totalQuantity);
                window.location = "/epasale/cart.php";
            });
        }
    }

    // Iterate over each seller card and call the handling function
    for (var i = 0; i < seller__card.length; i++) {
        handleSellerCard(seller__card[i]);
    }
});
