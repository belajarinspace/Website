document.getElementById("tambah-bahan").addEventListener("click", function() {
    var bahanContainer = document.getElementById("bahan-container");

    var divBahan = document.createElement("div"); // Membuat div baru untuk bahan
    var inputNamaBahan = document.createElement("input");
    inputNamaBahan.setAttribute("type", "text");
    inputNamaBahan.setAttribute("name", "bahan[nama_bahan][]");
    inputNamaBahan.setAttribute("placeholder", "Nama bahan");
    inputNamaBahan.setAttribute("required", "required");

    var inputJumlah = document.createElement("input");
    inputJumlah.setAttribute("type", "text");
    inputJumlah.setAttribute("name", "bahan[jumlah][]");
    inputJumlah.setAttribute("placeholder", "Jumlah");
    inputJumlah.setAttribute("required", "required");

    divBahan.appendChild(inputNamaBahan);
    divBahan.appendChild(inputJumlah);
    bahanContainer.appendChild(divBahan);
});

document.getElementById("tambah-langkah").addEventListener("click", function() {
    var ol = document.querySelector("ol");
    var li = document.createElement("li");
    var inputLangkah = document.createElement("input");
    inputLangkah.setAttribute("type", "text");
    inputLangkah.setAttribute("name", "langkah[]");
    inputLangkah.setAttribute("placeholder", "Langkah");
    inputLangkah.setAttribute("required", "required");

    li.appendChild(inputLangkah);
    ol.appendChild(li);
});
