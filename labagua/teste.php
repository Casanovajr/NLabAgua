<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/e837a9f141.js" crossorigin="anonymous"></script>

    <title>LabAgua PCT(guama)</title>
</head>
<body class="h-full">

<!-- Barra Superior -->
<header class="bg-white shadow-md">
    <div class="container mx-auto flex flex-wrap md:flex-nowrap items-center justify-between py-4">

        <!-- Logo Governo do Pará -->
        <a href="/" class="mt-4 ml-2 md:mt-0">
            <img src="/img/Captura de tela 2025-01-08 173216.png" alt="Logo Governo do Pará" class="h-12">
        </a>

        <!-- Logo UEPA -->
        <a href="/" class="mt-4 md:mt-0">
            <img src="\img\Captura de tela 2025-01-08 173548.png" alt="Logo UEPA" class="h-12">
        </a>

        <!-- Logo LabÁgua -->
        <a href="/" class="mt-4 md:mt-0">
            <img src="/img/LabAguaLogo.jpg" alt="Logo LabÁgua" class="h-12">
        </a>

        <!-- Ícones Sociais -->
        <div class="flex items-center justify-center md:justify-end space-x-4 mt-4 md:mt-0">
            <a href="#" class="text-gray-500 hover:text-blue-500">
                <i class="fab fa-facebook-f text-2xl"></i> <!-- Ícone do Facebook -->
            </a>
            <a href="#" class="text-gray-500 hover:text-blue-500">
                <i class="fab fa-twitter text-2xl"></i> <!-- Ícone do Twitter -->
            </a>
            <a href="https://www.instagram.com/labagua?igsh=ZmZ2Nzh1d21sajdn" class="text-gray-500 hover:text-pink-500">
                <i class="fab fa-instagram text-2xl"></i> <!-- Ícone do Instagram -->
            </a>
            <a href="#" class="text-gray-500 hover:text-red-500">
                <i class="fab fa-youtube text-2xl"></i> <!-- Ícone do YouTube -->
            </a>
        </div>
    </div>
</header>

<!-- Menu Inferior -->
<nav class="bg-blue-500 text-white">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between py-3">
        <!-- Links de Navegação -->
        <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6 font-semibold justify-center md:justify-start">
            <li><a href="#" class="hover:underline">Início</a></li>
            <li><a href="/postagem/create" class="hover:underline">Criar Post</a></li>
            <li><a href="https://aguasdamazonia.com/plataforma/iqa.html" class="hover:underline">Calculadora IQA</a></li>
            <li><a href="/blog" class="hover:underline">Produções</a></li>
            <li><a href="/blog" class="hover:underline">Projetos </a></li>
            <li><a href="/analise" class="hover:underline">Solicitar uma análise</a></li>
        </ul>

        <!-- Barra de Pesquisa -->
        <form class="flex items-center space-x-2 mt-4 md:mt-0 justify-center md:justify-end" action="/" method="GET">
            <input
                type="text"
                placeholder="O que você procura?"
                class="px-4 py-2 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-white"
                name="buscar"
            >
            <button type="submit" class="bg-white text-blue-500 px-4 py-2 rounded-full hover:bg-gray-200">
                <i class="fa fa-search"></i> <!-- Ícone de Busca -->
            </button>
            <button type="submit" class="bg-white text-blue-500 px-4 py-2 rounded-full hover:bg-gray-200">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                <a href="/servicos/login">Login</a>
            </button>
        </form>
    </div>
</nav>
<!-- Hero Section -->
<main class="container mx-auto flex flex-col md:flex-row items-center px-4 py-16">

    <!-- Text Content -->
    <div class="flex-1 text-center md:text-left mb-10 md:mb-0">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">
            LabAgua <br class="hidden md:block" />
            <span class="text-indigo-600">Laboratório de Qualidade de Água da Amazônia (LabÁgua)</span>
        </h1>
        <p class="text-gray-600 text-lg mb-6">

            O Laboratório de Qualidade da Água da Amazônia (LabÁgua), vinculado a Universidade do Estado do Pará (Uepa), atua em áreas como análises ambientais e monitoramento ambiental, e com serviços de análises de nutrientes e microbiológicas, licenciamento ambiental, monitoramento de corpos hídricos, entre outros.
        </p>
    </div>

    <!-- Image Section -->
    <div class="flex-1">
        <img class="h-auto max-w-full" src="/img/LabAguaLogo.png" alt="Logotipo do LabÁgua">
    </div>

</main>

<!-- Sobre o Laboratório Section -->
<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">Sobre o Laboratório</h2>
        <p class="text-center text-gray-600 mb-12">
            Foi criado em 2021, com a vocação de ser referência em análises ambientais de águas e efluentes na região amazônica.
            Fruto de um projeto apoiado pela Fundação Amazônia de Amparo a Estudos e Pesquisas (Fapespa) e pela Universidade do Estado
            do Pará (UEPA), surge o LabÁgua, localizado no Parque de Ciência e Tecnologia Guamá (PCT Guamá). Composto por uma equipe interdisciplinar
            de pesquisadores, tendo como objetivo desenvolver pesquisa, extensão e prestação de serviços com eficiência para a comunidade.
        </p>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-center mb-4">
                    <i class="fa-regular fa-flag"></i>
                </div>
                <h3 class="text-blue-600 text-lg font-semibold text-center mb-2">Missão</h3>
                <p class="text-gray-600 text-sm text-center">
                    Fornecer serviços de qualidade aos seus clientes, proporcionando segurança, confiabilidade e satisfação nos resultados das análises da qualidade da água.
                </p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-center mb-4">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3 class="text-blue-600 text-lg font-semibold text-center mb-2">Visão</h3>
                <p class="text-gray-600 text-sm text-center">
                    Tornar-se um laboratório de referência estadual, conceituado entre as instituições públicas e privadas, investindo em qualidade e inovação.
                </p>
            </div>
            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-center mb-4">
                    <i class="fa-solid fa-house"></i>
                </div>
                <h3 class="text-blue-600 text-lg font-semibold text-center mb-2">Valores</h3>
                <p class="text-gray-600 text-sm text-center">
                    Compromisso com a pesquisa, extensão e qualidade. Respeito, trabalho em equipe e responsabilidade social e ambiental.

                </p>
            </div>
        </div>
    </div>
</section>
<!-- Seção Equipe -->
<section class="py-16">
    <div class="container mx-auto px-4 text-center">
        <!-- Título -->
        <h1 class="text-2xl font-bold text-green-800 mb-8">EQUIPE DE PESQUISADORES</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">

            <!-- Card 1 -->
            <div class="flex flex-col items-center">
                <img src="/img/11.jpg" alt="Hebe Morganne Campos Ribeiro" class="w-32 h-32 rounded-lg shadow-md object-cover mb-4">
                <h2 class="text-lg font-medium text-gray-800">Hebe Morganne Campos Ribeiro</h2>
                <p class="text-xl font-bold text-blue-500">Coordenadora Geral</p>
                <a href="http://lattes.cnpq.br/2399134205919272" class="text-blue-500 hover:underline mt-2">Lattes</a>
            </div>

            <!-- Card 2 -->
            <div class="flex flex-col items-center">
                <img src="/i" alt="Junior" class="w-32 h-32 rounded-lg shadow-md object-cover mb-4">
                <h2 class="text-lg font-medium text-gray-800"> Junior</h2>
                <p class="text-xl font-bold text-blue-500">Bolsista</p>
                <a href="#" class="text-blue-500 hover:underline mt-2">Lattes</a>
            </div>

            <!-- Card 3 -->
            <div class="flex flex-col items-center">
                <img src="/img/14.png" alt="Caroline Nunes Carr" class="w-32 h-32 rounded-lg shadow-md object-cover mb-4">
                <h2 class="text-lg font-medium text-gray-800">Caroline Nunes Carr</h2>
                <p class="text-xl font-bold text-blue-500">Bolsista</p>
                <a href="http://lattes.cnpq.br/4845348191439715" class="text-blue-500 hover:underline mt-2">Lattes</a>
            </div>

            <!-- Card 4 -->
            <div class="flex flex-col items-center">
                <img src="/img/Imagem do WhatsApp de 2025-01-31 à(s) 10.09.47_75cdc467.jpg" alt="Ivan Junior" class="w-32 h-32 rounded-lg shadow-md object-cover mb-4">
                <h2 class="text-lg font-medium text-gray-800">Ivan Junior</h2>
                <p class="text-xl font-bold text-blue-500">Bolsista</p>
                <a href="#" class="text-blue-500 hover:underline mt-2">Lattes</a>
            </div>

            <!-- Card 5 -->
            <div class="flex flex-col items-center">
                <img src="" alt="Kauan Da Silva Pacheco" class="w-32 h-32 rounded-lg shadow-md object-cover mb-4">
                <h2 class="text-lg font-medium text-gray-800">Kauan Da Silva Pacheco</h2>
                <p class="text-xl font-bold text-blue-500">Bolsista</p>
                <a href="#" class="text-blue-500 hover:underline mt-2">Lattes</a>
            </div>

        </div>

        <!-- Botão -->
        <div class="mt-8">
            <button class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                Veja a Equipe
            </button>
        </div>
    </div>
</section>

<!-- Seção - Últimas Postagens -->
<section class="py-10 bg-white shadow-md">
    <div class="container mx-auto px-4">
        <!-- Título -->
        <div class="flex items-center space-x-4 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z" />
            </svg>
            <h2 class="text-2xl font-bold text-blue-600">Últimas Postagens</h2>
        </div>
        <div class="w-full border-t-2 border-blue-200 mb-6"></div>

        <!-- Grid de Postagens -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Início do Loop -->

            <!-- Fim do Loop -->
        </div>
    </div>
    <!-- Botão -->
    <div class="mt-8 flex justify-center">
        <a href="/blog">
            <button class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                Veja Mais
            </button>
        </a>
    </div>
</section>

<!-- Galeria Multimídia -->
<section class="py-10">
    <div class="container mx-auto px-4">
        <!-- Título -->
        <h2 class="text-3xl font-extrabold mb-6 text-center">Galeria Multimídia</h2>
        <!-- Grid de Imagens -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="relative group">
                <img src="https://via.placeholder.com/400x250" alt="Galeria 1" class="rounded-lg w-full h-48 object-cover border border-white shadow-lg">
                <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex flex-col justify-end p-4 opacity-0 group-hover:opacity-100 transition">
                    <p class="text-white text-sm"><i class="fas fa-camera"></i> (63)</p>
                    <p class="text-sm text-gray-200">14/JAN/2025</p>
                    <h3 class="text-white font-bold">Gestão Superior entrega equipamentos ao CCSE</h3>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="relative group">
                <img src="https://via.placeholder.com/400x250" alt="Galeria 2" class="rounded-lg w-full h-48 object-cover border border-white shadow-lg">
                <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex flex-col justify-end p-4 opacity-0 group-hover:opacity-100 transition">
                    <p class="text-white text-sm"><i class="fas fa-camera"></i> (12)</p>
                    <p class="text-sm text-gray-200">14/JAN/2025</p>
                    <h3 class="text-white font-bold">Oficina Servidor Empreendedor</h3>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="relative group">
                <img src="https://via.placeholder.com/400x250" alt="Galeria 3" class="rounded-lg w-full h-48 object-cover border border-white shadow-lg">
                <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex flex-col justify-end p-4 opacity-0 group-hover:opacity-100 transition">
                    <p class="text-white text-sm"><i class="fas fa-camera"></i> (24)</p>
                    <p class="text-sm text-gray-200">08/JAN/2025</p>
                    <h3 class="text-white font-bold">Atividades do Ano Novo Chinês</h3>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="relative group">
                <img src="https://via.placeholder.com/400x250" alt="Galeria 4" class="rounded-lg w-full h-48 object-cover border border-white shadow-lg">
                <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 flex flex-col justify-end p-4 opacity-0 group-hover:opacity-100 transition">
                    <p class="text-white text-sm"><i class="fas fa-camera"></i> (53)</p>
                    <p class="text-sm text-gray-200">08/JAN/2025</p>
                    <h3 class="text-white font-bold">Inauguração do Prédio de Dermatologia CCBS</h3>
                </div>
            </div>
        </div>

        <!-- Botão - Mais Galerias -->
        <div class="mt-8 flex justify-center">
            <a href="#" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                Mais Imagens [+]
            </a>
        </div>
    </div>
</section>





<!-- Seção - Acesso Rápido -->
<section class="py-10 bg-white shadow-md">
    <div class="container mx-auto px-4">
        <!-- Título -->
        <div class="flex items-center space-x-4 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-4.553A9 9 0 1112 3v7l6 3z" />
            </svg>
            <h2 class="text-2xl font-bold text-red-600">Acesso rápido</h2>
        </div>
        <div class="w-full border-t-2 border-red-200 mb-6"></div>

        <!-- Grid de Links -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            <!-- Card 1 -->
            <a href="https://aguasdamazonia.com/" class="flex flex-col items-center justify-center border border-gray-300 hover:shadow-md p-4 bg-white">
                <h3 class="font-bold text-blue-900 text-lg">ÁGUAS D'AMAZÔNIA </h3>
                <span class="mt-2 h-1 w-12 bg-red-600"></span>
            </a>

            <!-- Card 2 -->
            <a href="#" class="flex flex-col items-center justify-center border border-gray-300 hover:shadow-md p-4 bg-white">
                <h3 class="font-bold text-blue-900 text-lg text-center">Ministério da Saude</h3>
                <span class="mt-2 h-1 w-12 bg-red-600"></span>
            </a>

            <!-- Card 3 -->
            <a href="https://www.uepa.br/" class="flex flex-col items-center justify-center border border-gray-300 hover:shadow-md p-4 bg-white">
                <h3 class="font-bold text-blue-900 text-lg">UEPA</h3>
                <p class="text-sm text-center text-gray-600 mt-2">Universidade do Estado do Pará</p>
                <span class="mt-2 h-1 w-12 bg-red-600"></span>
            </a>

            <!-- Card 4 -->
            <a href="https://www.gov.br/cnpq/pt-br" class="flex flex-col items-center justify-center border border-gray-300 hover:shadow-md p-4 bg-white">
                <h3 class="font-bold text-blue-900 text-lg">CNPQ</h3>
                <p class="text-sm text-center text-gray-600 mt-2">Conselho Nacional de Desenvolvimento Científico e Tecnológico</p>
                <span class="mt-2 h-1 w-12 bg-red-600"></span>
            </a>

            <!-- Card 5 -->
            <a href="https://www.gov.br/mcti/pt-br" class="flex flex-col items-center justify-center border border-gray-300 hover:shadow-md p-4 bg-white">
                <h3 class="font-bold text-blue-900 text-lg text-center">MCTI</h3>
                <p class="text-sm text-center text-gray-600 mt-2">Ministério da Ciência, Tecnologia e Inovação</p>
                <span class="mt-2 h-1 w-12 bg-red-600"></span>

            </a>
            </a>
        </div>
    </div>
</section>
<!-- Footer -->
<footer class="bg-indigo-900 text-white py-10">
    <div class="container mx-auto px-4 flex flex-col lg:flex-row items-center justify-between space-y-6 lg:space-y-0">

        <!-- Logo Lab -->
        <div class="flex items-center space-x-4">
            <img src="/img/LabAguaLogoPB.png" alt="Logo Governo do Pará" class="h-12">
        </div>

        <!-- Social Links -->
        <div class="flex items-center space-x-6">
            <a href="#" class="text-gray-400 hover:text-white">
                <i class="fab fa-youtube text-2xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white">
                <i class="fab fa-twitter text-2xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white">
                <i class="fab fa-instagram text-2xl"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white">
                <i class="fab fa-facebook text-2xl"></i>
            </a>
        </div>

        <!-- Endereço -->
        <div class="text-gray-300 text-center lg:text-right space-y-2">
            <p class="text-lg font-semibold">Parque de Ciência e Tecnologia (PCT) Guamá</p>
            <p class="text-sm">
                <i class="fas fa-map-marker-alt"></i>
                Avenida Perimetral da Ciência km 01, S/N - Guamá, Belém - PA, 66075-750
            </p>
        </div>
    </div>

    <!-- Links Inferiores -->
    <div class="border-t border-indigo-800 mt-8 pt-4">
        <div class="container mx-auto px-4 flex flex-wrap justify-center lg:justify-between text-gray-300 text-sm space-y-4 lg:space-y-0">
            <a href="#" class="hover:underline">Governo do Pará</a>
            <span class="hidden lg:inline-block">|</span>
            <a href="#" class="hover:underline">UEPA</a>
            <span class="hidden lg:inline-block">|</span>
            <a href="#" class="hover:underline">CNPq</a>
            <span class="hidden lg:inline-block">|</span>
            <a href="#" class="hover:underline">MCTI</a>
            <span class="hidden lg:inline-block">|</span>
            <a href="https://www.pctguama.org.br/" class="hover:underline">PCT</a>
        </div>
    </div>
</footer>
</body>
</html>