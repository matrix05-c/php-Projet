let product_map = new Map();
product_list.forEach(product => {
    product_map[product.numProd] = product;
});

console.log(product_map)

//procust_list;
const product_input = document.getElementById("product-type-input");//select
const product_stock_display = document.getElementById("product-stock");//stock
const product_cost_display = document.getElementById("product-cost");//prix
const quatity_input = document.getElementById("product-purchase-quatity");//quantite

updateProductData();
product_input.addEventListener("change", updateProductData);
quatity_input.addEventListener("change", updateProductData);


function updateProductData() {
    let current_product = product_input.value;

    console.log(product_map[current_product].prixProduit);

    updateQuatityLimit(current_product);
    updateCost(current_product);
    updateStock(current_product);
};

function updateQuatityLimit(current_product) {
    let product_stock = product_map[current_product].stock;
    let quatity = quatity_input.value;

    if (quatity > product_stock) {
        quatity_input.value = product_stock;
    }
}

function updateCost(current_product) {
    let quatity = quatity_input.value;
    let product_cost = product_map[current_product].prixProduit;
    let purchase_cost = (product_cost && quatity) ? product_cost * quatity : 0;

    product_cost_display.innerHTML = purchase_cost;
}

function updateStock(current_product) {
    let product_stock = product_map[current_product].stock;
    product_stock_display.innerHTML = product_stock;
}
