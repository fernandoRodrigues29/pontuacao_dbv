# 🏕️ Sistema de Pontuação de Desbravadores

Sistema web para gerenciamento e pontuação de atividades do Clube de Desbravadores, desenvolvido com CodeIgniter 3. Facilita o controle de pontos, especialidades e o acompanhamento do progresso de cada desbravador.

![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.x-EF4223?logo=codeigniter&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green)
![Status](https://img.shields.io/badge/Status-Ativo-success)

---

## 📋 Sobre o Projeto

Este sistema nasceu da necessidade de **digitalizar e automatizar** o controle de pontuações em Clubes de Desbravadores, substituindo planilhas manuais e facilitando a vida de diretores, instrutores e secretários.

### 🎯 Problemas que Resolve

- ✅ Eliminação de planilhas manuais confusas
- ✅ Centralização de dados de desbravadores
- ✅ Cálculo automático de pontuações
- ✅ Histórico completo de atividades
- ✅ Relatórios para reuniões administrativas
- ✅ Controle de presença em eventos

---

## ⚡ Funcionalidades

### 👥 Gestão de Desbravadores
- Cadastro completo de membros
- Organização por unidades
- Controle de classes (Amigo, Companheiro, Pesquisador, etc.)
- Histórico individual de participação

### 📊 Sistema de Pontuação
- Registro de atividades e eventos
- Pontuação automática por tipo de atividade
- Ranking geral e por unidades
- Pontos para especialidades conquistadas

### 📈 Relatórios
- Relatório mensal de atividades
- Desempenho individual
- Comparativo entre unidades
- Especialidades concluídas

### 🎖️ Especialidades
- Cadastro de especialidades
- Controle de progresso
- Requisitos por especialidade
- Certificados digitais

---

## 🛠️ Tecnologias Utilizadas

- **Backend:** CodeIgniter 3.1.x
- **Linguagem:** PHP 7.4+
- **Banco de Dados:** MySQL 5.7+ / MariaDB
- **Frontend:** HTML5, CSS3, Bootstrap 4
- **JavaScript:** jQuery, DataTables
- **Extras:** Chart.js (gráficos), jsPDF (relatórios)

---

## 📦 Instalação

### Pré-requisitos

```bash
PHP >= 7.4
MySQL >= 5.7 ou MariaDB >= 10.3
Apache/Nginx com mod_rewrite habilitado
Composer (opcional, para dependências extras)
```

### Passo a Passo

1. **Clone o repositório**
```bash
git clone https://github.com/fernandoRodrigues29/pontuacao_dbv.git
cd pontuacao_dbv
```

2. **Configure o banco de dados**
```bash
# Crie o banco de dados
mysql -u root -p -e "CREATE DATABASE pontuacao_dbv CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Importe o schema (arquivo SQL estará em /database/)
mysql -u root -p pontuacao_dbv < database/schema.sql
```

3. **Configure a aplicação**
```bash
# Copie o arquivo de configuração
cp application/config/database.php.example application/config/database.php

# Edite com suas credenciais
nano application/config/database.php
```

Exemplo de configuração:
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'seu_usuario',
    'password' => 'sua_senha',
    'database' => 'pontuacao_dbv',
    'dbdriver' => 'mysqli',
    'char_set' => 'utf8mb4',
);
```

4. **Configure permissões**
```bash
chmod -R 755 application/cache
chmod -R 755 application/logs
chmod -R 755 uploads
```

5. **Configure o .htaccess** (se usar Apache)
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

6. **Acesse o sistema**
```
http://localhost/pontuacao_dbv
```

**Login Padrão:**
- Usuário: `admin`
- Senha: `admin123`

⚠️ **IMPORTANTE:** Altere a senha padrão imediatamente após primeiro acesso!

---

## 🗂️ Estrutura do Projeto

```
pontuacao_dbv/
├── application/
│   ├── controllers/      # Controladores (lógica de negócio)
│   │   ├── Desbravadores.php
│   │   ├── Pontuacao.php
│   │   ├── Especialidades.php
│   │   └── Relatorios.php
│   ├── models/           # Models (acesso a dados)
│   │   ├── Desbravador_model.php
│   │   ├── Pontuacao_model.php
│   │   └── Especialidade_model.php
│   ├── views/            # Views (templates)
│   │   ├── dashboard/
│   │   ├── desbravadores/
│   │   ├── pontuacao/
│   │   └── layouts/
│   ├── config/           # Configurações
│   │   ├── database.php
│   │   ├── routes.php
│   │   └── config.php
│   └── libraries/        # Bibliotecas customizadas
├── assets/
│   ├── css/              # Estilos
│   ├── js/               # Scripts
│   └── img/              # Imagens
├── uploads/              # Uploads (fotos, documentos)
├── database/             # Scripts SQL
│   ├── schema.sql        # Estrutura do BD
│   └── seed.sql          # Dados de exemplo
└── index.php             # Ponto de entrada
```

---

## 🚀 Como Usar

### 1. Dashboard Inicial
Ao fazer login, você verá:
- Total de desbravadores ativos
- Eventos do mês
- Ranking das unidades
- Especialidades em andamento

### 2. Cadastrar Desbravador
```
Menu > Desbravadores > Novo Cadastro
```
Preencha: Nome, Data de Nascimento, Unidade, Classe

### 3. Registrar Pontuação
```
Menu > Pontuação > Nova Pontuação
```
Selecione: Desbravador, Atividade, Pontos

### 4. Gerar Relatório
```
Menu > Relatórios > Escolha o tipo
```
Exporte em PDF ou imprima direto

---

## 📸 Screenshots

> **Nota:** Adicione capturas de tela reais do sistema aqui

| Dashboard | Cadastro de Desbravadores |
|-----------|---------------------------|
| ![Dashboard](docs/screenshots/dashboard.png) | ![Cadastro](docs/screenshots/cadastro.png) |

| Ranking | Relatórios |
|---------|------------|
| ![Ranking](docs/screenshots/ranking.png) | ![Relatórios](docs/screenshots/relatorios.png) |

---

## 🔒 Segurança

- ✅ Proteção contra SQL Injection (uso de prepared statements)
- ✅ Validação de inputs (XSS protection)
- ✅ CSRF protection habilitado
- ✅ Senhas hasheadas com bcrypt
- ✅ Controle de sessões
- ✅ Diferentes níveis de acesso (Admin, Diretor, Instrutor)

---

## 🌐 Deploy

### Opção 1: InfinityFree (Grátis)
1. Crie conta em https://infinityfree.net
2. Faça upload via FTP
3. Importe o banco via phpMyAdmin
4. Configure `application/config/database.php`

### Opção 2: Railway.app (Grátis)
```bash
railway login
railway init
railway add mysql
railway up
```

### Opção 3: Servidor Próprio
- Certifique-se que PHP e MySQL estão instalados
- Configure virtual host apontando para a pasta do projeto
- Ajuste permissões de pastas

---

## 🐛 Solução de Problemas

**Erro: "Database connection failed"**
```bash
# Verifique as credenciais em application/config/database.php
# Certifique-se que o MySQL está rodando
sudo service mysql status
```

**Erro 404 nas rotas**
```bash
# Habilite mod_rewrite no Apache
sudo a2enmod rewrite
sudo service apache2 restart
```

**Página em branco**
```bash
# Ative o modo de debug
# Em application/config/config.php, mude:
$config['log_threshold'] = 4;
# Veja os erros em application/logs/
```

---

## 📈 Roadmap

### Versão 2.0 (Planejado)
- [ ] App mobile (React Native)
- [ ] Integração com WhatsApp para notificações
- [ ] Sistema de badges digitais
- [ ] Galeria de fotos de eventos
- [ ] Exportação de carteirinhas
- [ ] API REST para integrações

### Melhorias Futuras
- [ ] Migração para Laravel
- [ ] Dashboard com gráficos interativos
- [ ] Multi-idiomas (PT/ES/EN)
- [ ] Sistema de votação para líderes

---

## 🤝 Como Contribuir

Contribuições são muito bem-vindas! Aqui está como você pode ajudar:

1. **Fork** este repositório
2. Crie uma **branch** para sua feature (`git checkout -b feature/MinhaFeature`)
3. **Commit** suas mudanças (`git commit -m 'Add: nova funcionalidade X'`)
4. **Push** para a branch (`git push origin feature/MinhaFeature`)
5. Abra um **Pull Request**

### Padrão de Commits
```
Add: nova funcionalidade
Fix: correção de bug
Update: atualização de código
Refactor: refatoração
Docs: documentação
```

---

## 📝 Licença

Este projeto está sob a licença **MIT**. Veja o arquivo [LICENSE](license.txt) para mais detalhes.

Isso significa que você pode:
- ✅ Usar comercialmente
- ✅ Modificar
- ✅ Distribuir
- ✅ Uso privado

---

## 💬 Suporte

Encontrou um bug? Tem uma sugestão?

- 🐛 [Abra uma Issue](https://github.com/fernandoRodrigues29/pontuacao_dbv/issues)
- 💡 [Discussões](https://github.com/fernandoRodrigues29/pontuacao_dbv/discussions)
- 📧 Email: seuemail@exemplo.com

---

## 👨‍💻 Autor

**Fernando Rodrigues**

- GitHub: [@fernandoRodrigues29](https://github.com/fernandoRodrigues29)
- LinkedIn: [Seu LinkedIn]
- Email: contato@exemplo.com

---

## 🙏 Agradecimentos

- Clube de Desbravadores **[Nome do Clube]** pela inspiração e testes
- Comunidade CodeIgniter pelo framework
- Todos os colaboradores que testaram e deram feedback

---

## 📊 Estatísticas

![GitHub last commit](https://img.shields.io/github/last-commit/fernandoRodrigues29/pontuacao_dbv)
![GitHub issues](https://img.shields.io/github/issues/fernandoRodrigues29/pontuacao_dbv)
![GitHub pull requests](https://img.shields.io/github/issues-pr/fernandoRodrigues29/pontuacao_dbv)

---

<div align="center">

**Desenvolvido com ❤️ para facilitar a gestão de Clubes de Desbravadores**

⭐ Se este projeto te ajudou, deixe uma estrela no repositório!

[⬆️ Voltar ao topo](#-sistema-de-pontuação-de-desbravadores)

</div>