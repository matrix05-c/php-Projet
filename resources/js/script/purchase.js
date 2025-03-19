const product_input = document.getElementById("product-type-input");
const product_stock_display = document.getElementById("product-stock");
const product_cost_display = document.getElementById("product-cost");
const quatity_input = document.getElementById("product-purchase-quatity");

updateProductData();
product_input.addEventListener("change", updateProductData);
quatity_input.addEventListener("change", updateProductData);


function updateProductData() {
    let current_product = product_input.value;

    console.log(current_product);

    updateQuatityLimit(current_product);
    updateCost(current_product);
    updateStock(current_product);
};

function updateQuatityLimit(current_product) {
    let product_stock = product_list[current_product].stock;
    let quatity = quatity_input.value;
    
    if (quatity > product_stock) {
        quatity_input.value = product_stock;
    }
}

function updateCost(current_product) {
    let quatity = quatity_input.value;
    let product_cost = product_list[current_product].cost;
    let purchase_cost = (product_cost && quatity)? product_cost*quatity: 0;
    
    product_cost_display.innerHTML = purchase_cost;
}

function updateStock(current_product) {
    let product_stock = product_list[current_product].stock;
    product_stock_display.innerHTML = product_stock;
}
