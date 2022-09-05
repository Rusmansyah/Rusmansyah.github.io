<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bottom Navbar Bootstrap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
    <div class="container mt-4">
        <h2 class="alert alert-info">
            Tutorial Menampilkan Data Google SpreadSheet dengan Php
        </h2>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td>No</td>
                        <td>Timestamp</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Question</td>
                    </tr>
                    <?php
                    $no = 1;
                    ?>
                    <!-- $newArray adalah variabel yang didapatkan dari data.php  -->
                    <?php foreach ($newArray as $value) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $value["timestamp"]; ?></td>
                            <td><?php echo $value["name"]; ?></td>
                            <td><?php echo $value["email"]; ?></td>
                            <td><?php echo $value["question"]; ?></td>
                        </tr>

                    <?php } ?>
                </table>

                <form name="submit-to-google-sheet">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="email_anda@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="question" class="form-label">Pesan</label>
                        <textarea name="question" class="form-control" id="question" rows="3"></textarea>
                    </div>

                    <button class="btn btn-outline-primary btn-kirim" type="submit">Send</button>
                    <button class="btn btn-primary btn-loading d-none" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>

                </form>
            </div>
        </div>
    </div>


    <!-- script submit to google sheet -->
    <script>
        const scriptURL = 'https://script.google.com/macros/s/AKfycbwcWF1n6rEBYIUVQSsNfK8RfUJSHT0_BVhICt-0zS_gt8I0SP7ht36awqk_mroyW9z3/exec';
        const form = document.forms['submit-to-google-sheet'];
        const btnKirim = document.querySelector('.btn-kirim');
        const btnLoading = document.querySelector('.btn-loading');

        form.addEventListener('submit', e => {
            e.preventDefault();
            // ketika btn-kirim diklik
            // tampilkan btn-loading, hilangkan btn-kirim
            btnLoading.classList.toggle('d-none');
            btnKirim.classList.toggle('d-none');
            fetch(scriptURL, {
                    method: 'POST',
                    body: new FormData(form)
                })
                .then(response => {
                    // tampilkan btn-kirim, hilangkan btn-loading
                    btnLoading.classList.toggle('d-none');
                    btnKirim.classList.toggle('d-none');

                    // reset form (hilangkan tulisan yg ada di form)
                    form.reset();
                    console.log('Success!', response)
                })
                .catch(error => console.error('Error!', error.message));
        });
    </script>

</body>

</html>