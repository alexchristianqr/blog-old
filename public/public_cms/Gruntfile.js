module.exports = function (grunt) {
    grunt.initConfig({
        clean: {
            build: {
                src: ['css/styles.min.css', 'js/app.min.js']
            }
        },
        cssmin: {
            combine: {
                dest: 'css/styles.min.css',
                src: [
                    '../bower_components/font-awesome/css/font-awesome.min.css',
                    '../bower_components/bootstrap/dist/css/bootstrap.min.css',
                    '../bower_components/metisMenu/dist/metisMenu.min.css',
                    'css/sb-admin-2.css',
                    'css/styles.css'
                ]
            }
        },
        requirejs: {
            compile: {
                options: {
                    almond: true,
                    baseUrl: ".",
                    out: 'js/app.min.js',
                    name: 'main_cms',
                    mainConfigFile: 'main_cms.js',
                    include: ['../bower_components/requirejs/require'],
                    preserveLicenseComments: false
                }
            }
        },
        jshint: {
            all: ['Gruntfile.js', 'js/**/*.js', 'main_cms.js']
        }
    });

    //Cargamos las tareas Grunt
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-requirejs');
    grunt.loadNpmTasks('grunt-contrib-jshint');

    //Registramos las tareas Grunt
    grunt.registerTask('doclean', ['clean']);
    grunt.registerTask('jscheck', ['jshint']);
    grunt.registerTask('jso', ['requirejs']);

    //todo> tarea que crea el archivo de estilo minificado en "CSS".
    grunt.registerTask('minify', ['cssmin']);

    //todo> tarea que crea el archivo de javascript minificado en "JS".
    grunt.registerTask('jsapp', ['jshint', 'requirejs']);

    //todo> tarea que realiza todos los archivos minificados para el ambiente de "PRODUCCION".
    grunt.registerTask('runapp', ['jscheck','doclean', 'minify', 'requirejs']);

    //todo> tarea que realiza todos los archivos minificados para el ambiente de "post PRODUCCION".
    grunt.registerTask('run', ['doclean', 'minify', 'requirejs']);
};