<!-- Formulário de Contato -->
<div class="contact-form" data-aos="fade-up" data-aos-delay="200">
                    <form id="contactForm" action="includes/contact.php" method="POST">
                        <div class="form-group">
                            <label for="name">Nome Completo *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-mail *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Telefone *</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="service">Tipo de Serviço *</label>
                            <select id="service" name="service" required>
                                <option value="">Selecione um serviço</option>
                                <option value="residencial">Análise Residencial</option>
                                <option value="comercial">Análise Comercial</option>
                                <option value="industrial">Análise Industrial</option>
                                <option value="curso">Curso de Certificação</option>
                                <option value="emergencia">Teste de Emergência</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mensagem</label>
                            <textarea id="message" name="message" rows="5" placeholder="Descreva suas necessidades ou dúvidas..."></textarea>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="newsletter" value="1">
                                <span class="checkmark"></span>
                                Desejo receber informações sobre novos serviços e promoções
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-large">
                            <i class="fas fa-paper-plane"></i>
                            Enviar Mensagem
                        </button>
                    </form>
                </div>