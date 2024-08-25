function changeQuantity(amount) {
  var quantityInput = document.getElementById("quantity");
  var currentQuantity = parseInt(quantityInput.value);
  var newQuantity = currentQuantity + amount;
  if (newQuantity > 0) {
    quantityInput.value = newQuantity;
  }
}
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".plus, .minus").forEach((button) => {
    button.addEventListener("click", () => {
      const input = button.parentElement.querySelector(".quantity");
      let value = parseInt(input.value, 10);

      if (button.classList.contains("plus")) {
        value += 1;
      } else if (button.classList.contains("minus") && value > 1) {
        value -= 1;
      }

      input.value = value;

      const productId = input.dataset.productId;
      console.log(productId, value);
      updateCart(productId, value);
    });
  });
});
function updateCart(productId, quantity) {
  fetch("update_cart.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ productId, quantity }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        console.log("Cart updated successfully");
        location.reload();
      } else {
        console.error("Failed to update cart");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
