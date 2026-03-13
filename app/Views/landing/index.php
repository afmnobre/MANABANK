<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANABANK | Gestão Inteligente para Lojas de TCG</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --mana-primary: #00d4ff;
            --mana-dark: #0d1117;
            --mana-card: #161b22;
            --mana-accent: #ffc107;
        }

        body {
            background-color: var(--mana-dark);
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Hero Section */
        .hero-section {
            padding: 100px 0;
            background: radial-gradient(circle at top right, rgba(0, 212, 255, 0.15), transparent);
        }

        .mana-title {
            font-size: 3.5rem;
            font-weight: 800;
            letter-spacing: -1px;
            background: linear-gradient(90deg, #fff, var(--mana-primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-mana {
            background-color: var(--mana-primary);
            color: #000;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 8px;
            transition: 0.3s;
            border: none;
            display: inline-block;
            text-decoration: none;
            text-align: center;
        }

        .btn-mana:hover {
            background-color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 212, 255, 0.3);
            color: #000;
        }

        /* Features */
        .feature-card {
            background: var(--mana-card);
            border: 1px solid #30363d;
            border-radius: 16px;
            padding: 30px;
            height: 100%;
            transition: 0.3s;
        }

        .feature-card:hover {
            border-color: var(--mana-primary);
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--mana-primary);
            margin-bottom: 20px;
        }

        /* Pricing */
        .price-card {
            background: linear-gradient(145deg, #1c2128, #161b22);
            border: 1px solid #30363d;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            transition: 0.3s;
            height: 100%;
        }

        .price-card.border-mana {
            border: 2px solid var(--mana-primary);
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.1);
        }

        .mockup-container {
            position: relative;
            border: 8px solid #30363d;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }

        .badge-new {
            background: var(--mana-accent);
            color: #000;
            font-weight: bold;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .footer {
            border-top: 1px solid #30363d;
            padding: 50px 0;
            color: #8b949e;
        }

        .text-cyan { color: var(--mana-primary); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark pt-4">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <i class="bi bi-cpu-fill text-cyan me-2"></i> MANABANK
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-uppercase small fw-bold">
                    <li class="nav-item"><a class="nav-link px-3" href="#funcionalidades">Funcionalidades</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#ranking">Fidelização</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#precos">PLANOS/Preços</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="badge-new mb-3">SISTEMA PARA LOJAS NERD</span>
                    <h1 class="mana-title mb-4">Eleve sua loja ao próximo nível.</h1>
                    <p class="lead text-secondary mb-5">O <strong>MANABANK</strong> é o ecossistema definitivo para gerir torneios, fidelizar jogadores e controlar seu estoque de TCG em um só lugar.</p>
                    <div class="d-flex gap-3">
                        <a href="#precos" class="btn btn-mana text-uppercase">Começar Agora</a>
                        <button class="btn btn-outline-light px-4 py-2 fw-bold">Ver Demo</button>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="mockup-container">
                        <img src="https://images.unsplash.com/photo-1611162617474-5b21e879e113?auto=format&fit=crop&q=80&w=1000" class="img-fluid" alt="Dashboard Manabank">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="funcionalidades" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Tudo o que seu negócio geek precisa</h2>
                <p class="text-secondary">Desenvolvido por quem entende de TCG para quem vive de TCG.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-trophy feature-icon"></i>
                        <h4>Gestão de Torneios</h4>
                        <p class="text-secondary small">Organize chaves, rodadas e premiações de forma automatizada e profissional.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-person-badge feature-icon"></i>
                        <h4>Painel do Jogador</h4>
                        <p class="text-secondary small">Seus clientes acompanham o próprio ranking, histórico de pedidos e pontos acumulados.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="bi bi-graph-up-arrow feature-icon"></i>
                        <h4>Controle Financeiro</h4>
                        <p class="text-secondary small">Relatórios detalhados de vendas, lucro por categoria e movimentação de caixa.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="ranking" class="py-5" style="background-color: #010409;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <h2 class="fw-bold mb-4">Rankings Mensais e Anuais que engajam</h2>
                    <p class="text-secondary">Crie um ambiente competitivo e saudável. O MANABANK calcula automaticamente o Top 5 da sua loja, incentivando os jogadores a voltarem sempre.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check2-circle text-cyan me-2"></i> Filtro por Cardgame específico</li>
                        <li class="mb-2"><i class="bi bi-check2-circle text-cyan me-2"></i> Pontuação configurável por evento</li>
                        <li class="mb-2"><i class="bi bi-check2-circle text-cyan me-2"></i> Visual otimizado para mobile</li>
                    </ul>
                </div>
                <div class="col-lg-7 text-center">
                     <div class="p-4 bg-dark rounded border border-secondary shadow">
                        <div class="row g-2">
                            <div class="col-4 bg-white rounded-start p-3 text-dark small fw-bold">LOGO JOGO</div>
                            <div class="col-4 bg-dark p-3 border-start border-secondary small">RANK MENSAL</div>
                            <div class="col-4 bg-secondary p-3 rounded-end small">RANK ANUAL</div>
                        </div>
                        <p class="mt-3 text-white-50 small italic">Exemplo do Painel Público do Jogador</p>
                     </div>
                </div>
            </div>
        </div>
    </section>

<section id="precos" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-white">Escolha seu Plano</h2>
            <p class="text-secondary">Assine agora e configure sua loja em poucos minutos.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <?php
            if (!empty($planos) && is_array($planos)):
                foreach ($planos as $p):
                    // 1. Sanitização preventiva para evitar quebras
                    $slug  = isset($p['slug']) ? $p['slug'] : '';
                    $nome  = isset($p['nome']) ? $p['nome'] : 'Plano';
                    $valor = isset($p['valor']) ? (float)$p['valor'] : 0;
                    $id    = isset($p['id']) ? $p['id'] : '';
                    $dias  = isset($p['intervalo_dias']) ? $p['intervalo_dias'] : '0';

                    // 2. Definição visual
                    $isAnual = ($slug === 'anual');
                    $borderClass = $isAnual ? 'border-mana' : '';
                    $labelTempo = $isAnual ? '/ano' : '/mês';

                    // 3. Proteção para a URL (Evita o Fatal Error Undefined Constant)
                    $urlBase = defined('BASE_URL') ? BASE_URL : '/';
            ?>
                <div class="col-md-5">
                    <div class="price-card shadow-lg <?php echo $borderClass; ?>">

                        <?php if($isAnual): ?>
                            <span class="badge-new mb-3 d-inline-block">MELHOR CUSTO-BENEFÍCIO</span>
                        <?php endif; ?>

                        <h2 class="fw-bold mb-3"><?php echo htmlspecialchars($nome); ?></h2>

                        <div class="display-4 fw-bold mb-4 text-cyan">
                            R$ <?php echo number_format($valor, 2, ',', '.'); ?>
                            <small class="fs-6 text-white-50"><?php echo $labelTempo; ?></small>
                        </div>

                        <ul class="list-unstyled text-start mb-4 text-secondary">
                            <li class="mb-2"><i class="bi bi-check2 text-cyan me-2"></i> Todos os módulos inclusos</li>
                            <li class="mb-2"><i class="bi bi-check2 text-cyan me-2"></i> Gestão de atendentes</li>
                            <li class="mb-2"><i class="bi bi-check2 text-cyan me-2"></i> Suporte Prioritário</li>
                            <li class="mb-2"><i class="bi bi-check2 text-cyan me-2"></i> Período: <?php echo $dias; ?> dias</li>
                        </ul>

                        <form action="<?php echo $urlBase; ?>landing/configurar" method="POST">
                            <input type="hidden" name="plano_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="plano_slug" value="<?php echo $slug; ?>">
                            <button type="submit" class="btn btn-mana btn-lg text-uppercase w-100">Contratar Agora</button>
                        </form>
                    </div>
                </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

    <footer class="footer mt-5 text-center">
        <div class="container">
            <h5 class="fw-bold text-white mb-3">MANABANK</h5>
            <p class="mb-4 small">O sistema de varejo feito para o universo geek.</p>
            <div class="d-flex justify-content-center gap-4 mb-4">
                <a href="#" class="text-secondary"><i class="bi bi-instagram fs-4"></i></a>
                <a href="#" class="text-secondary"><i class="bi bi-linkedin fs-4"></i></a>
                <a href="#" class="text-secondary"><i class="bi bi-whatsapp fs-4"></i></a>
            </div>
            <p class="small">&copy; 2026 MANABANK RETAIL SYSTEM. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
