# melhor-caminho
Author: Francisco Matelli Matulovic

Locale: Itapetininga, Sao Paulo

Data: 25/03/2016

Site: http://franciscomat.com

Live-demo: http://franciscomat.com/melhor-caminho/

INSTALAÇÃO
Basta clonar o repositório em um servidor PHP, dentro da pasta /mapas existem 4 arquivos de exemplo para serem utilizados

RELATÓRIO TÉCNICO
Além do requirido no corpo da mensagem abaixo foi explicitado que era necessário uma solução PHP puro, no início realmente estranhei porque a vaga era para WordPress e o desafio parecia a princípio mais relacionado a ciência da programação do que a prática de programação wordpress.

A primeira coisa que se destaca é a complexidade do algorítimo exigido para a realização dos inúmeros cálculos que uma simples rota exige, além disto aumenta-se exponencialmente a necessidade de cálculos aumentando-se a quantidade de pontos no mapa. 

A princípio imaginei que a dificuldade a ser superada seria a obtenção de um algorítimo superior, porém o fundamento deste cálculo é com base numa fórmula clássica denominada Djikstra, utilizado inclusive pelo Google Maps. Então a minha primeira tentativa foi utilizar a API do Google Maps para passar pontos reais no mapa e utilizar o algorítimo interno da própria API para receber a melhor rota.

Porém ao estudar mais o fundo o problema percebi que existiam diversas regras de negócio escondidas por trás de um formato simples que eu nunca havia tido contato antes, o formato de malha logística. Ao reler o enunciado do desafio outras de vezes percebi que este formato é de malha pode ter sido gerado por outro programa, que exporta esta lista formatada.

Então reinicie meus esfoços , encontrei uma bibliota PHP de DJIKSTRA para fazer o cálculo e trabalhei para converter o formato de malha logística puro para um array associativo para o algorítimo interno do sistema.

Essa conversão porém não é 100% eficiente, pois para cada valor da linha de malha são feitas 2 entradas no array, talvez exista uma forma de otimizar isso com mais tempo. Sou um profissional do tipo criativo, este tipo é o tipo de desafio que também desafia meu impulso de ser criativo, exigindo concentração para resolver o problema como ele se apresenta.

O sistema tem um webservice para passar os dados e retorna os valores, que podem ser utilizados até mesmo por outros programas.

.: entregando mercadorias

O XXXXXXXX esta desenvolvendo um novo sistema de logistica e sua 

ajuda é muito importante neste momento. Sua tarefa será desenvolver 

o novo sistema de entregas visando sempre o menor custo. Para 

popular sua base de dados o sistema precisa expor um Webservices que 

aceite o formato de malha logística (exemplo abaixo), nesta mesma 

requisição o requisitante deverá informar um nome para este mapa. É 

importante que os mapas sejam persistidos para evitar que a cada 

novo deploy todas as informações desapareçam. O formato de malha 

logística é bastante simples, cada linha mostra uma rota: ponto de 

origem, ponto de destino e distância entre os pontos em quilômetros.

A B 10

B D 15

A C 20

C D 30

B E 50

D E 30

Com os mapas carregados o requisitante irá procurar o menor valor de 

entrega e seu caminho, para isso ele passará o nome do ponto de 

origem, nome do ponto de destino, autonomia do caminhão (km/l) e o 

valor do litro do combustivel, agora sua tarefa é criar este 

Webservices. Um exemplo de entrada seria, origem A, destino D, 

autonomia 10, valor do litro 2,50; a resposta seria a rota A B D com 

custo de 6,25.

Voce está livre para definir a melhor arquitetura e tecnologias para 

solucionar este desafio, mas não se esqueça de contar sua motivação 

no arquivo README que deve acompanhar sua solução, junto com os 

detalhes de como executar seu programa. Documentação e testes serão 

avaliados também =) Lembre-se de que iremos executar seu código com 

malhas beeemm mais complexas, por isso é importante pensar em 

requisitos não funcionais também!!

Também gostariamos de acompanhar o desenvolvimento da sua aplicação 

através do código fonte. Por isso, solicitamos a criação de um 

repositório que seja compartilhado com a gente. Para o 

desenvolvimento desse sistema, nós solicitamos que você utilize a 

sua (ou as suas) linguagem de programação principal. Pode ser Java, 

JavaScript ou Ruby.