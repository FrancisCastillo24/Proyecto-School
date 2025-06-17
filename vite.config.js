import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/cursos/curso.js', // tu JS extra
                'resources/js/admin/student/student-form.js', // tu JS extra
                'resources/js/user/booking/formReserva.js', // tu JS extra
                'resources/js/admin/student/form-creationStudent.js', // tu JS extra
            ],
            refresh: true,
        }),
    ],
});
