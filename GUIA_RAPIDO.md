# 🚀 Guia Rápido - LabÁgua no XAMPP

## ✅ Arquivos Copiados com Sucesso!

Os arquivos foram copiados para: `/Applications/XAMPP/xamppfiles/htdocs/labag/`

---

## 🔧 Passos para Testar:

### 1. **Iniciar o XAMPP**
- Abra o XAMPP Control Panel
- Clique em **Start** para **Apache**
- Clique em **Start** para **MySQL**
- Aguarde até ficar verde

### 2. **Teste Básico do PHP**
```
http://localhost/labag/test-php.php
```
- ✅ Verifica se PHP está funcionando
- ✅ Testa conexão com banco
- ✅ Mostra quantos posts/membros existem

### 3. **Se Banco Vazio, Importe os Dados**
```
http://localhost/labag/test-import.php
```
- ✅ Cria banco automaticamente
- ✅ Importa todas as tabelas
- ✅ Insere dados de exemplo

### 4. **Teste o Site Principal**
```
http://localhost/labag/index.php
```
- ✅ Deve mostrar posts e membros
- ✅ PHP processado corretamente

---

## 📊 O Que Deve Aparecer:

### **Seção "Últimos Artigos":**
- ✅ **3 Posts** sobre qualidade da água
- ✅ Títulos, autores e datas
- ✅ Links funcionais

### **Seção "Nossa Equipe":**
- ✅ **3 Membros** da equipe
- ✅ Fotos (avatar padrão)
- ✅ Cargos e especialidades
- ✅ Links para Lattes

### **Dados de Exemplo Incluídos:**
- 📰 **Posts:** "Qualidade da Água", "Análise Microbiológica", "Legislação"
- 👥 **Membros:** Dr. Carlos Silva, Dra. Maria Santos, Dr. João Oliveira
- 👤 **Admin:** admin@labagua.com / password

### **Área Admin Completa:**
- 🔐 **Login:** `http://localhost/labag/admin/login.php`
- 📊 **Dashboard:** Gerenciamento completo do site
- 📝 **Posts:** Criar, editar e excluir artigos
- 👥 **Membros:** Adicionar e gerenciar equipe
- 📧 **Contatos:** Ver mensagens de contato
- 👤 **Usuários:** Administrar usuários do sistema
- ⚙️ **Configurações:** Configurar o sistema
- 📨 **Newsletter:** Gerenciar inscritos

---

## 🔍 Se Der Erro 404:

### **Verifique:**
1. **XAMPP está rodando?**
   - Apache: Verde ✅
   - MySQL: Verde ✅

2. **URL correta:**
   - ✅ `http://localhost/labag/test-php.php`
   - ❌ `http://localhost/labagua/test-php.php`

3. **Arquivos no lugar certo:**
   - ✅ `/Applications/XAMPP/xamppfiles/htdocs/labag/`

---

## 🎯 Próximos Passos:

### **Se tudo funcionar:**
1. ✅ Teste `http://localhost/labag/index.php`
2. ✅ Teste `http://localhost/labag/articles.php`
3. ✅ Teste `http://localhost/labag/members.php`
4. ✅ Teste `http://localhost/labag/test-admin.php` (área admin)
5. ✅ Teste `http://localhost/labag/admin/login.php` (login admin)

### **Se houver problemas:**
1. ✅ Execute `http://localhost/labag/test-simple.php`
2. ✅ Execute `http://localhost/labag/test-index.php`
3. ✅ Execute `http://localhost/labag/test-resources.php`
4. ✅ Execute `http://localhost/labag/test-login-status.php` (status do login)
5. ✅ Execute `http://localhost/labag/test-requireAuth.php` (teste de autenticação)
6. ✅ Execute `http://localhost/labag/debug-admin.php` (debug completo)
7. ✅ Execute `http://localhost/labag/admin/dashboard-test.php` (dashboard sem login)
8. ✅ Execute `http://localhost/labag/admin/index-simple.php` (dashboard simplificado)
9. ✅ Execute `http://localhost/labag/admin/index-nojs.php` (dashboard sem JavaScript)
10. ✅ Execute `http://localhost/labag/admin/index-debug.php` (dashboard com debug)
11. ✅ Execute `http://localhost/labag/admin/index-fixed.php` (dashboard corrigido)
12. ✅ Verifique logs do XAMPP

---

## 🗑️ Limpeza (Opcional):

Após confirmar que tudo funciona, você pode deletar:
- `test-php.php`
- `test-import.php`
- `test-db.php`
- `test-admin.php`
- `simple-test.php`
- `test.html`
- `test.php`
- `debug.php`

---

## 📞 Suporte:

Se ainda houver problemas:
1. Verifique se o XAMPP está rodando
2. Confirme a URL: `http://localhost/labag/`
3. Execute os testes em ordem
4. Verifique os logs do Apache

**🎉 Boa sorte! O site deve funcionar perfeitamente agora!**
