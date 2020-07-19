<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.rawgit.com/axios/axios/master/dist/axios.min.js"></script>
</head>

<body>
    <?php require('nav.html') ?>

    <div id=app>
        <div class="container">
            <h1>Testimonios</h1>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-success" @click="postTestimonios()">Agregar testimonio</button>
                </div>
            </div>
            <br>
            <div class="row" v-if="Testimonios.length!=0">

                <div class="col-4" v-for="(item,index) in Testimonios" :key="index">
                    <br>
                    <div class="card" style="width: auto;">
                        <div class="card-header">
                            <h5 class="card-title">Tipo de testimonio: {{item.tipo}}</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Estado: {{item.estado}}</h6>
                            <p class="card-text">{{item.strTestimonio}}</p>

                            <div class="heart"></div>
                            <button type="button" class="btn btn-primary" @click="addReacción(1,item.id)">
                                <i class="fa fa-heart" aria-hidden="true"></i> Like <span
                                    class="badge badge-danger">{{item.reacciones}}</span>
                            </button>

                        </div>
                        <div class="card-footer text-muted">
                            hace 1 dia
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="https://use.fontawesome.com/7ad89d9866.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        /* when a user clicks, toggle the 'is-animating' class */


        const HTTP = axios.create({
            baseURL: "./process/processTestimonios.php/"
        })
        var app = new Vue({
            el: '#app',
            data: {
                Testimonios: [],
                testimonio: {},


            },
            created() {
                this.getTestimonios()

            },
            methods: {
                getTestimonios() {
                    HTTP
                        .get("/usuarios") // Es como concatenar './servidor.php/' y 'usuarios'
                        .then(respuesta => {
                            if (respuesta.data != "error") {

                                this.Testimonios = respuesta.data;
                            }

                        })
                        .catch((e) => {
                            console.log('error' + e);
                        });
                },
                postTestimonios() {
                    Swal.mixin({
                        confirmButtonText: 'Next &rarr;',
                        showCancelButton: true,
                        progressSteps: ['1', '2', '3']
                    }).queue([
                        {
                            title: '¿De que estado de la republica Mexicana eres?',
                            input: 'text',
                        },
                        {
                            title: '¿Qué tipo de violencia sufriste?',
                            input: 'select',
                            inputOptions: {
                                'Tipos de violencia': {
                                    'Violencia física': 'Violencia física',
                                    'Violencia patrimonial': 'Violencia patrimonial',
                                    'Violencia económica': 'Violencia económica',
                                    sexual: 'Violencia sexual'
                                }
                            }
                        },
                        {
                            title: 'Cuentanos tu historia',
                            input: 'textarea',
                        },

                    ]).then((result) => {
                        if (result.value) {
                            const answers = JSON.stringify(result.value)
                            this.testimonio = answers;
                            console.log(this.testimonio);
                            this.upTestim();
                        }
                    })

                },
                upTestim() {
                    HTTP
                        .post("/usuario", this.testimonio)
                        .then(res => {
                            if (res.data == "done") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Testimonio añadido correctamente.',

                                })
                                this.getTestimonios()
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Algo salio mal.',
                                })
                            }
                        });
                },
                addReacción(reaccion, id) {
                    data = JSON.stringify({ reaccion, id })
                    HTTP
                        .put("/usuario", data)
                        .then(respuesta => {
                            this.getTestimonios()
                        });

                }
            },
        })
    </script>
</body>

</html>