<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Post::factory()
        //     ->count(100)
        //     ->create();

        Post::create([
            'user_id' => 6,
            'category_id' => 4,
            'published' => 1,
            'title' => 'Maju Bersama Dev Handal',
            'slug' => 'maju-bersama-dev-handal',
            'content' => '{
                "time": 1708881440763,
                "blocks": [
                    {
                        "id": "8MSGcMFSkS",
                        "type": "header",
                        "data": {
                            "text": "Program Beasiswa Devhandal khusus di Tahun Kabisat",
                            "level": 2
                        }
                    },
                    {
                        "id": "5QSxb2qg7X",
                        "type": "header",
                        "data": {
                            "text": "Intro",
                            "level": 3
                        }
                    },
                    {
                        "id": "Msc7-4HEKp",
                        "type": "paragraph",
                        "data": {
                            "text": "Saat ini dunia tengah mengalami sebuah transformasi besar-besaran. Digitalisasi dilakukan oleh hampir semua lini di kehidupan. Dari ekonomi, bisnis, perbankan, hingga pemerintahan menerapkan digitalisasi.&nbsp;",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "c4lEYev7Tg",
                        "type": "paragraph",
                        "data": {
                            "text": "Untuk melakukan digitalisasi beberapa perusahaan bahkan merubah bisnis model dan perilaku perusahaan yang berlandaskan pada kemajuan teknologi. Salah satu upaya digitalisasi yang tak pernah salah sasaran adalah dengan meng-<i>online</i> kan entitasnya melewati website.",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "FlJD5P-VTy",
                        "type": "paragraph",
                        "data": {
                            "text": "Dengan adanya kesempatan besar ini, saya memiliki ketertarikan bergabung ke dalam kapal besar ini. Background pendidikan yang saya miliki tidak ada hubungannya dengan dunia IT, seorang lulusan sarjana Teknik Geologi. Namun demikian, berdasarkan passion lain dalam diri yang haus akan pengetahuan dan perkembangan, saya memutuskan untuk terjun langsung, dengan belajar membuat website dan blog, bahkan semenjak bangku SMP. Dan jangan salah, meskipun Geologi termasuk ilmu yang terkesan jauh dengan IT, perlahan saya meningkatkan skill sebagai seorang developer, yang nantinya akan mempermudah pula, kerja seorang geolog dengan bantuan AI, Machine Learning, dan project opensource yang sudah menjadi plan saya kedepan.",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "nBYREBinSN",
                        "type": "header",
                        "data": {
                            "text": "Devhandal x Codepolitan",
                            "level": 3
                        }
                    },
                    {
                        "id": "6vxUdBCT8i",
                        "type": "image",
                        "data": {
                            "file": {
                                "url": "https://blog.test/storage/post-images/aaaaa/temp-images/XoGVqdrvFAJMz8OOWLODDHiDC1ooFM5MJ0qqiLsr.png"
                            },
                            "caption": "KodeBisat by Devhandal<br>",
                            "withBorder": false,
                            "stretched": false,
                            "withBackground": false
                        }
                    },
                    {
                        "id": "0ttfJ8IunT",
                        "type": "paragraph",
                        "data": {
                            "text": "Awal mula menemukan platform devhandal ini, berawal dari rutinitas saya mengais ilmu di YouTube. Awal tahun 2024 ketika explore channel youtube salah satu pengajar web yang sedang naik daun, pak Sandhika Galih dengan channel <a href=\"https://www.youtube.com/@sandhikagalihWPU\">Web Programming UNPAS</a>&nbsp;-nya. Dari sana muncul ketertarikan untuk mencoba mengikuti event beasiswa menjadi seorang web developer.",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "5BN1HvH2ue",
                        "type": "paragraph",
                        "data": {
                            "text": "Tech stack yang ditawarkan dalam beasiswa <a href=\"https://devhandal.id?reference=BRTR5\">KodeBisat</a> ini adalah Laravel dan MEVN, dua dari beberapa tech stack populer dalam web developer. Saya sangat tertarik memperdalam karena secara kebetulan, blog ini sebetulnya sedang dalam tahap development menggunakan platform Laravel. Oleh karena syarat untuk bergabung ke dalam beasiswa adalah membuat blog post, maka saya percepat deployment blog ini. Saya ingin mencoba untuk belajar menggunakan stack lain yakni MEVN (MongoDB, ExpressJS, Vue.js, dan Node.js), karena sangat populer dan powerful.",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "GValsa0DdP",
                        "type": "paragraph",
                        "data": {
                            "text": "Di awal pembelajaran saya tentang web development, saya sangat anti dengan namanya JavaScript, karena banyak sekali coding yang belum saya pahami. Namun semakin mendalami web development saya semakin sadar, aspek lain yang harus dipertimbangkan selain kostum dan kosmetik web adalah experience user, yang dengan sangat mudah diatasi dengan adanya JavaScript.",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "-xrgNq9CPT",
                        "type": "paragraph",
                        "data": {
                            "text": "Devhandal dan Codepolitan akan sangat membantu dalam path pembelajaran web development saya. MongoDB yang notabene cukup terkenal dalam pengembangan Machine Learning, bisa saya dapatkan dengan gratis; kembali mengingat bahwa project selanjutnya yang saya rencanakan adalah mengawinkan antara web, yang akan dapat mengirim request dan menerima respons data, sedangngkan machine learning sebagai service yang bekerja di balik layar. Saya sangat terbuka untuk mengenal tech stack baru, karena bukan tidak mungkin, platform yang saya gunakan dan merasa nyaman saat ini, akan jauh tertinggal ke depan.",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "D0xGJtZFTg",
                        "type": "paragraph",
                        "data": {
                            "text": "Framework Express.js, Vue.js dan runtime Node.js bahkan semuanya berbasiskan kepada JavaScript. Dan saya rasa sekalian saja saya akan mencebur untuk memperdalam JavaScript. Mencoba mencicipi framework javascript sangat menyenangkan. Ke depan, menjadi full stack JS mungkin menjadi salah satu milestone yang ingin saya capai.",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "Lr5HNN4vwQ",
                        "type": "header",
                        "data": {
                            "text": "Alibaba Cloud",
                            "level": 3
                        }
                    },
                    {
                        "id": "ZD7TfL-A_8",
                        "type": "image",
                        "data": {
                            "file": {
                                "url": "https://blog.test/storage/post-images/aaaaa/temp-images/6IZIX2w5SbWem1ZW5E4XeOVviJunGrIy3JmgW9yI.jpg"
                            },
                            "caption": "",
                            "withBorder": false,
                            "stretched": false,
                            "withBackground": false
                        }
                    },
                    {
                        "id": "URCV5FU93L",
                        "type": "paragraph",
                        "data": {
                            "text": "Pertama kali mencoba cloud server, adalah menggunakan Alibaba Cloud. Sebelumnya server yang pernah saya coba hanyalah localhost dan shared web hosting, yang tentu saja tidak bisa sepowerfull cloud. Speed salah satu aspek yang diunggulkan, dan kebanyakan downtime lebih sedikit terjadi, karena layanan yang umumnya lebih diprioritaskan.",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "vJo1BOXY28",
                        "type": "paragraph",
                        "data": {
                            "text": "Fitur trial yang cukup lengkap, sangat mencukupi untuk belajar mengenai DevOps, dan tentu saja sebagai fullstack developer, sangat mungkin peran ini kita ambil sendiri ke depan. Banyak peluang yang bisa diambil dengan menggunakan cloud service. Experience yang bisa saya bayangkan adalah dengan mudah deploy dan build package ke server, tanpa banyak memikirkan masalah kompatibilitas.",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "mlZ5KW8E91",
                        "type": "header",
                        "data": {
                            "text": "Kesimpulan",
                            "level": 3
                        }
                    },
                    {
                        "id": "5-X8KjelAK",
                        "type": "paragraph",
                        "data": {
                            "text": "Event besar ini merupakan kesempatan yang sangat baik bagi saya secara khusus, dan para techsavvy di luar sana untuk memperdalam pengembangan website menggunakan Laravel dan MEVN. Platform yang digandeng juga tidak main-main dan sangat kompeten di dunia komersial. Semoga dengan adanya event beasiswa <a href=\"https://devhandal.id?reference=BRTR5\">KodeBisat</a> ini, ke depan semakin banyak anak-anak Indonesia yang berminat dan dapat menyalurkan bakat mereka.",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "HXN5dkjSDe",
                        "type": "paragraph",
                        "data": {
                            "text": "Reference :",
                            "alignment": "left"
                        }
                    },
                    {
                        "id": "7hCgNBo0dQ",
                        "type": "list",
                        "data": {
                            "style": "ordered",
                            "items": [
                                "<a href=\"https://codepolitan.com\">Codepolitan</a>",
                                "<a href=\"https://alibabacloud.com\">Alibaba Cloud</a>",
                                "<a href=\"https://devhandal.id\">Devhandal.id</a>"
                            ]
                        }
                    }
                ],
                "version": "2.28.2"
            }'
        ]);
    }
}
