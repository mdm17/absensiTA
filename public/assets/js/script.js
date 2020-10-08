$('#exampleModal1').on('show.bs.modal', function (e) {

    var button = $(e.relatedTarget)
    var nama = button.data('nama')
    const baseUrl = "http://127.0.0.1:8000/";
    const getMovie = () => {
        fetch(`${baseUrl}akumulasi/${nama}`)
            .then(response => {
                return response.json();
            })
            .then(responseJson => {
                if (responseJson.error) {
                    showResponseMessage(responseJson.message);
                } else {
                    renderAllBooks(responseJson.success);
                }
            })
            .catch(error => {
                showResponseMessage(error);
            })
        // try {
        //     const response = await fetch(`${baseUrl}ruang/${nama}`);
        //     const responseJson = await response.json();
        //     if (responseJson.error) {
        //         showResponseError(responseJson.error);
        //     } else {
        //         showResponseMessage(responseJson.success);
        //     }

        // } catch (error) {
        //     showResponseMessage(error);
        // }
    };

    const renderAllBooks = (allMovie) => {
        allMovie.forEach(movie => {

            document.getElementById("kompen").innerHTML = movie.kompen;

            movie.mahasiswa.forEach(mahasiswa => {
                document.getElementById("exampleModalLabel").innerHTML = mahasiswa.nama;
            })
            // document.getElementsById("modal-content").innerHTML = `<a href="${dataURL}" target="_blank" download="image.png"> download</a>`
        });
    };

    const showResponseMessage = (message = "Check your internet connection") => {
        alert(message);
    };
    getMovie();
    // var modal = $(this)
    // modal.find('.modal-title').html(nama)
})
