let service_map = new Map();
service_list.forEach(service => {
    service_map[service.numServ] = service;
});

console.log(service_map);
console.log(service_list);

const service_input = document.getElementById("service-type-input");
const service_cost_display = document.getElementById("service-cost");

updateServiceData();
service_input.addEventListener("change", updateServiceData);

function updateServiceData() {
    console.log(document.getElementById("service-type-input").value);
    let current_service = service_map[service_input.value];
    let service_cost = current_service.prix;
    service_cost_display.innerHTML = service_cost;
};
