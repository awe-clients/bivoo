# 🚀 GUIA RÁPIDO - INSTALAÇÃO DO TEMA WORDPRESS BIVOO

## 📦 PASSO 1: PREPARAR O TEMA

### Opção A: Criar ZIP manualmente
1. Acesse a pasta: `/mnt/user-data/outputs/wordpress-theme/`
2. Comprima todos os arquivos em um ZIP
3. Nomeie como: `bivoo-theme.zip`

### Opção B: Via terminal
```bash
cd /mnt/user-data/outputs/
zip -r bivoo-theme.zip wordpress-theme/
```

## 🔧 PASSO 2: INSTALAR NO WORDPRESS

### Via WordPress Admin (Recomendado)
1. Acesse: `seu-site.com/wp-admin`
2. Vá em: **Aparência → Temas**
3. Clique em: **Adicionar Novo**
4. Clique em: **Fazer Upload do Tema**
5. Selecione: `bivoo-theme.zip`
6. Clique em: **Instalar Agora**
7. Após instalação, clique em: **Ativar**

### Via FTP/Servidor
1. Extraia o conteúdo de `bivoo-theme.zip`
2. Renomeie a pasta para: `bivoo`
3. Faça upload via FTP para: `/wp-content/themes/bivoo/`
4. No WordPress Admin, vá em **Aparência → Temas**
5. Ative o tema **Bivoo**

## ⚙️ PASSO 3: CONFIGURAÇÃO INICIAL

### 1. Estrutura de Arquivos (Verificar)
```
bivoo/
├── style.css ✅
├── functions.php ✅
├── header.php ✅
├── footer.php ✅
├── index.php ✅
├── single.php ✅
├── page.php ✅
├── template-homepage.php ✅
├── README.md ✅
├── assets/
│   └── js/
│       └── main.js ✅
└── template-parts/
    └── content-hospedagem-card.php ✅
```

### 2. Plugins Obrigatórios

Instale estes plugins:

**Advanced Custom Fields (ACF)**
- Vá em: **Plugins → Adicionar Novo**
- Busque: "Advanced Custom Fields"
- Instale e Ative

**Contact Form 7**
- Vá em: **Plugins → Adicionar Novo**
- Busque: "Contact Form 7"
- Instale e Ative

### 3. Configurar Permalinks

1. Vá em: **Configurações → Links Permanentes**
2. Selecione: **Nome do post**
3. Clique em: **Salvar alterações**

### 4. Criar Menus

**Menu Principal:**
1. Vá em: **Aparência → Menus**
2. Crie novo menu: "Menu Principal"
3. Marque: ☑️ Primary Menu
4. Adicione itens:
   - Início (home)
   - Hospedagens (URL: `/hospedagens`)
   - Experiências (URL: `/experiencias`)
   - Pacotes (URL: `/pacotes`)
   - Seguros (página)
   - Transfer (página)

**Menu Rodapé:**
1. Crie menu: "Menu Rodapé"
2. Marque: ☑️ Footer Menu
3. Adicione páginas institucionais

**Menu Mobile:**
1. Crie menu: "Menu Mobile"
2. Marque: ☑️ Mobile Menu
3. Adicione os mesmos itens do Menu Principal

### 5. Configurar Homepage

1. Crie página: "Início"
2. No editor, selecione: **Atributos da Página → Template → Homepage**
3. Publique
4. Vá em: **Configurações → Leitura**
5. Selecione:
   - ☑️ Uma página estática
   - Página Inicial: **Início**
6. Salve

### 6. Criar Páginas Básicas

Crie estas páginas:

```
✅ Início (Template: Homepage)
✅ Hospedagens
✅ Experiências  
✅ Pacotes
✅ Seguros
✅ Transfer
✅ Sobre Nós
✅ Contato
✅ Blog
✅ Termos de Uso
✅ Política de Privacidade
✅ LGPD
```

### 7. Configurar Customizador

Vá em: **Aparência → Personalizar**

**Identidade do Site:**
- Upload logo (300x100px)
- Tagline do site

**Informações de Contato:**
- Telefone: `0800 887 0248`
- E-mail: `contato@bivoo.com.br`
- Endereço: `Rua Bem e São Agostinho, Pipa/RN - CEP 59.178-000`

**Redes Sociais:**
- Facebook: URL completa
- Instagram: URL completa
- YouTube: URL completa
- LinkedIn: URL completa

## 📝 PASSO 4: ADICIONAR CONTEÚDO

### Criar Hospedagem (Post Type)

1. Vá em: **Hospedagens → Adicionar Nova**
2. Preencha:
   - Título: Ex: "Casa EPIPÃ"
   - Conteúdo: Descrição completa
   - Imagem Destacada: Foto principal
   - **Detalhes da Hospedagem:**
     - Preço por Noite: Ex: 1475.00
     - Número de Quartos: Ex: 3
     - Número de Banheiros: Ex: 2
     - Máximo de Hóspedes: Ex: 6
     - Avaliação: Ex: 4.9
3. Selecione **Destino**: Ex: Pipa, RN
4. Adicione **Comodidades**: Wi-Fi, Piscina, Ar-condicionado, etc.
5. Publique

### Criar Destino (Taxonomia)

1. Vá em: **Hospedagens → Destinos**
2. Adicione destinos:
   ```
   - Pipa, RN
   - Natal, RN
   - Tibau do Sul, RN
   - Maceió, AL
   - Búzios, RJ
   - Porto de Galinhas, PE
   ```

### Criar Comodidades (Taxonomia)

1. Vá em: **Hospedagens → Comodidades**
2. Adicione:
   ```
   - Wi-Fi
   - Piscina
   - Ar-condicionado
   - Estacionamento
   - Churrasqueira
   - Cozinha Completa
   - TV
   - Pet Friendly
   ```

## 🎨 PASSO 5: CUSTOMIZAÇÃO VISUAL

### Tailwind CSS (Já incluído)
O tema usa Tailwind CSS via CDN. Para produção, considere:

1. Instalar Tailwind localmente
2. Fazer build customizado
3. Incluir apenas classes usadas

### Fontes Google (Já incluído)
- Fonte: Rubik (300-900)
- Carregamento automático

### Font Awesome (Já incluído)
- Versão 6.4.0
- Carregamento via CDN

## ✅ CHECKLIST PÓS-INSTALAÇÃO

- [ ] Tema ativado
- [ ] Plugins obrigatórios instalados
- [ ] Permalinks configurados
- [ ] Menus criados e atribuídos
- [ ] Homepage configurada
- [ ] Páginas básicas criadas
- [ ] Logo adicionado
- [ ] Informações de contato preenchidas
- [ ] Redes sociais configuradas
- [ ] Pelo menos 1 hospedagem criada
- [ ] Destinos adicionados
- [ ] Comodidades adicionadas

## 🐛 SOLUÇÃO DE PROBLEMAS

### Tema não aparece na lista
- Verifique se todos os arquivos estão na pasta correta
- Confirme que `style.css` tem o cabeçalho correto
- Verifique permissões da pasta (755)

### Imagens não carregam
- Instale plugin: **Regenerate Thumbnails**
- Vá em: **Ferramentas → Regenerate Thumbnails**
- Click: **Regenerate All Thumbnails**

### Menus não aparecem
- Verifique se criou os menus
- Confirme que atribuiu às localizações corretas
- Limpe cache (se houver plugin de cache)

### Estilos não aplicam
1. Limpe cache do navegador (Ctrl+Shift+Del)
2. Se usar plugin de cache, limpe cache
3. Verifique se Tailwind CSS está carregando (F12 → Network)

### Campos personalizados não aparecem
- Verifique se ACF está ativo
- Vá em: **Hospedagens → Adicionar Nova**
- Role até o final da página
- Box "Detalhes da Hospedagem" deve aparecer

## 📞 SUPORTE

**E-mail:** suporte@bivoo.com.br  
**Telefone:** 0800 887 0248  
**Documentação:** Arquivo README.md incluído

## 🎉 PRONTO!

Seu tema Bivoo está instalado e configurado!

Próximos passos:
1. Adicionar mais hospedagens
2. Criar conteúdo para blog
3. Configurar formulários de contato
4. Otimizar SEO (Yoast SEO)
5. Configurar backup automático

---

**Desenvolvido com ❤️ pela equipe Bivoo**