-- SQLBook: Code
CREATE DATABASE TurismoBD;

USE TurismoBD;

CREATE TABLE Users(
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    FullName VARCHAR(255) NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Rol ENUM('administrador', 'usuario') DEFAULT 'usuario'
);

CREATE TABLE CategoriesDestinations(
    CategoryID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Description TEXT
);

CREATE TABLE Destinations(
    DestinationID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Description TEXT,
    Location VARCHAR(100) NOT NULL,
    Price DECIMAL(10,2) NOT NULL,
    Image VARCHAR(255) NOT NULL,
    CategoryID INT NOT NULL,
    FOREIGN KEY (CategoryID) REFERENCES CategoriesDestinations(CategoryID)
);

CREATE TABLE ProgrammedTrips (
    ProgrammedTripID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,            -- Nombre del viaje (ej. "Tour al Cusco")
    Description TEXT,                      -- Descripción del viaje
    StartDate DATE NOT NULL,               -- Fecha de inicio del viaje
    EndDate DATE NOT NULL,                 -- Fecha de finalización del viaje
    MaxCapacity INT NOT NULL,              -- Capacidad máxima de personas
    Price DECIMAL(10,2) NOT NULL,          -- Precio por persona
    DestinationID INT NOT NULL,
    FOREIGN KEY (DestinationID) REFERENCES Destinations(DestinationID)
);

CREATE TABLE Reservations(
    ReservationID INT PRIMARY KEY AUTO_INCREMENT,
    ProgrammedTripID INT NOT NULL,
    UserID INT NOT NULL,
    PhoneNumber VARCHAR(50) NOT NULL,
    ReservationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    NumberPeople INT NOT NULL,
    State ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente',
    FOREIGN KEY (ProgrammedTripID) REFERENCES ProgrammedTrips(ProgrammedTripID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE PaymentMethods(
    PaymentMethodID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULl,
    Description TEXT
);

CREATE TABLE Payments(
    PaymentID INT PRIMARY KEY AUTO_INCREMENT,
    ReservationID INT NOT NULL,
    PaymentMethodID INT NOT NULL,
    TotalAmount DECIMAL(10,2),
    PaymentDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ReservationID) REFERENCES Reservations(ReservationID),
    FOREIGN KEY (PaymentMethodID) REFERENCES PaymentMethods(PaymentMethodID)
);

CREATE TABLE Activities(
    ActivityID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Description TEXT,
    Price DECIMAL(10, 2) NOT NULL
);

CREATE TABLE Destination_Activities(
    DestinationID INT NOT NULL,
    ActivityID INT NOT NULL,
    FOREIGN KEY (DestinationID) REFERENCES Destinations(DestinationID),
    Foreign Key (ActivityID) REFERENCES Activities(ActivityID)
);

INSERT INTO Users (Username, Password, FullName, Email, Rol) VALUES ("admin_t", "$2y$10$XrQAd0LdwSGwMiIlN2nbbOQHM312GByluBcYGiAo36Ealak64GM4C", "Jean Estrella", "jeanestrella558@gmail.com", "administrador");

INSERT INTO CategoriesDestinations (Name, Description) VALUES 
('Cultural', 'Destinos enfocados en la cultura e historia de Perú, incluyendo sitios arqueológicos y tradiciones.'),
('Aventura', 'Destinos que ofrecen actividades de aventura como trekking, escalada y deportes extremos.'),
('Naturaleza', 'Destinos que destacan la belleza natural del Perú, como reservas naturales y paisajes impresionantes.'),
('Ecoturismo', 'Destinos que promueven la sostenibilidad y la conexión con la naturaleza.'),
('Aventura Extrema', 'Lugares que ofrecen experiencias emocionantes para los amantes de la adrenalina.'),
('Místico y Espiritual', 'Destinos con importancia espiritual o cultural en la historia del Perú.'),
('Arqueológico', 'Sitios históricos que muestran el legado de las civilizaciones antiguas.'),
('Pueblos Típicos y Artesanías', 'Destinos que destacan por sus tradiciones vivas y trabajos manuales.'),
('Gastronomía y Vinos', 'Experiencias enfocadas en la cocina local y la producción de bebidas típicas.'),
('Atractivos Naturales Únicos', 'Lugares con paisajes y características naturales singulares.');


INSERT INTO Destinations (Name, Description, Location, Price, Image, CategoryID) VALUES 
('Machu Picchu', 'Machu Picchu es una de las joyas arqueológicas más importantes del mundo, una maravilla que muestra la grandeza de la civilización inca. Ubicada en lo alto de una montaña, esta ciudadela es famosa por su arquitectura en piedra perfectamente ensamblada y sus impresionantes paisajes naturales. Su origen sigue siendo un misterio, pero muchos creen que fue un centro religioso, político y cultural.

Este sitio histórico ofrece una experiencia única para los visitantes, con la posibilidad de explorar el Templo del Sol, la Plaza Sagrada y la Intihuatana, una piedra ceremonial que marcaba los solsticios. Su ubicación estratégica también permite disfrutar de vistas impresionantes de los Andes y el río Urubamba que serpentea por el valle.

Viajar a Machu Picchu es más que una visita; es una conexión con la historia y la naturaleza. Los viajeros pueden optar por el famoso Camino Inca o tomar el tren panorámico para disfrutar de paisajes inolvidables antes de llegar a este destino mágico.', 'Cusco', 250.00, '../../assets/img/destination_machu_picchu.webp', 1),
('Líneas de Nazca', 'Las Líneas de Nazca son un enigma que ha desconcertado a arqueólogos y visitantes durante siglos. Estas gigantescas figuras trazadas en el desierto de Nazca representan animales, plantas y formas geométricas, visibles solo desde el aire. Se cree que fueron creadas por la cultura Nazca entre los años 500 a.C. y 500 d.C., pero su propósito sigue siendo un misterio.

Entre las figuras más emblemáticas se encuentran el colibrí, el mono y la araña, cada una cuidadosamente diseñada en un terreno árido y desafiante. Algunos expertos sugieren que podrían haber tenido un propósito ritual, astronómico o incluso extraterrestre.

Visitar las Líneas de Nazca es una experiencia surrealista. A través de sobrevuelos organizados, los viajeros pueden admirar estas creaciones únicas y reflexionar sobre el ingenio y la espiritualidad de una cultura antigua que dejó su marca en el mundo.', 'Ica', 150.00, '../../assets/img/destination_lineas_de_nazca.webp', 1),
('Paracas y las Islas Ballestas', 'La Reserva Nacional de Paracas y las Islas Ballestas son un paraíso para los amantes de la naturaleza. Este destino combina paisajes desérticos y marinos con una biodiversidad extraordinaria. Las Islas Ballestas, conocidas como las "Galápagos peruanas", son hogar de pingüinos, lobos marinos, pelícanos y otras especies únicas.

En la reserva, los visitantes pueden disfrutar de impresionantes vistas del desierto que se encuentra con el océano. Uno de los atractivos más icónicos es el Candelabro, un misterioso geoglifo grabado en una duna que se asemeja a un candelabro gigante, visible desde el mar.

Además de la rica fauna, Paracas es un lugar perfecto para practicar deportes acuáticos, disfrutar de paseos en bote y deleitarse con la gastronomía marina local, famosa por sus ceviches y platos frescos preparados con productos del Pacífico.', 'Ica', 120.00, '../../assets/img/destination_islas_ballestas.webp', 3),
('Laguna Humantay', 'La Laguna Humantay es uno de los lugares más mágicos del Perú, una laguna de aguas turquesas rodeada por los imponentes picos nevados de los Andes. Este destino es una parada imprescindible para los amantes del senderismo y la naturaleza, ubicado a más de 4,200 metros sobre el nivel del mar.

El camino hacia la laguna es desafiante pero gratificante. Durante la caminata, los viajeros atraviesan paisajes montañosos y pueden apreciar la flora y fauna típica de los Andes. Al llegar, la vista de la laguna es simplemente espectacular, con su color vibrante que refleja el cielo y las montañas.

Además de su belleza natural, la Laguna Humantay tiene un significado espiritual para las comunidades locales. Es considerada sagrada y se realizan rituales para rendir homenaje a la Pachamama (Madre Tierra), lo que añade una dimensión cultural y mística a la experiencia.', 'Cusco', 90.00, '../../assets/img/destination_laguna_humantay.webp
', 2),
('Cañón del Colca', 'El Cañón del Colca, en Arequipa, es uno de los cañones más profundos del mundo y un testimonio de la belleza natural y cultural del Perú. Con más de 3,000 metros de profundidad, este impresionante paisaje ofrece vistas panorámicas, pueblos tradicionales y una rica historia.

Uno de los mayores atractivos del Cañón del Colca es el avistamiento del majestuoso cóndor andino, que sobrevuela las corrientes térmicas del cañón. Estos imponentes pájaros son símbolos de los Andes y su vuelo es una experiencia inolvidable para los visitantes.

Además de su fauna, el cañón es hogar de comunidades locales que mantienen vivas las tradiciones ancestrales. Los viajeros pueden explorar terrazas agrícolas preincaicas, participar en actividades culturales y disfrutar de aguas termales naturales, haciendo de su visita una combinación perfecta de aventura y relajación.', 'Arequipa', 180.00, '../../assets/img/destination_canon_colca.webp', 3),
('Lago Titicaca y las Islas Uros', 'El Lago Titicaca, ubicado en los Andes peruanos, es el lago navegable más alto del mundo, alcanzando una altura de 3,812 metros sobre el nivel del mar. Este lugar sagrado para las culturas andinas es conocido por su imponente belleza natural y su relevancia histórica como el lugar donde, según la leyenda incaica, nacieron Manco Cápac y Mama Ocllo, fundadores del Imperio Inca. Sus aguas azules, tranquilas y rodeadas de montañas, ofrecen un paisaje incomparable que invita a la reflexión y el asombro.

Uno de los mayores atractivos del lago son las Islas Flotantes de los Uros, una comunidad indígena que vive en islas hechas completamente de totora, una planta acuática que crece en el lago. Los habitantes de estas islas han conservado sus tradiciones durante siglos, ofreciendo a los visitantes una experiencia única al mostrar cómo construyen sus islas, casas y embarcaciones utilizando este material. Además, los turistas pueden aprender sobre su cultura, participar en actividades locales y adquirir artesanías típicas.

El lago también cuenta con otras islas fascinantes, como Amantaní y Taquile, donde las comunidades locales viven de manera armónica con la naturaleza. Estas islas ofrecen caminatas panorámicas, templos prehispánicos y una vista privilegiada del lago y las montañas circundantes. Visitar el Lago Titicaca no solo es una inmersión en la naturaleza, sino también un viaje al corazón de la cultura viva del Perú.', 'Puno', 100.00, '../../assets/img/destination_lago_titicaca.webp', 3),
('Monasterio de Santa Catalina', 'Arequipa, conocida como la "Ciudad Blanca" por sus edificios de sillar, una piedra volcánica blanca, es una de las ciudades más hermosas y culturales del Perú. Su clima templado y sus impresionantes vistas del volcán Misti la convierten en un lugar ideal para los viajeros. Declarada Patrimonio de la Humanidad por la UNESCO, Arequipa es un destino que combina historia, arquitectura y una gastronomía excepcional. En sus calles se encuentran casonas coloniales, iglesias barrocas y plazas llenas de vida.

El Monasterio de Santa Catalina es uno de los mayores tesoros de la ciudad. Fundado en 1579, este convento ocupa una manzana entera y es una verdadera ciudad dentro de la ciudad. Sus coloridas calles, patios adornados con flores y pequeñas celdas monásticas transportan a los visitantes a un tiempo de meditación y contemplación. A pesar de ser un lugar de clausura por siglos, hoy está abierto al público y ofrece una experiencia única al explorar su rica historia religiosa y cultural.

Arequipa no solo es historia, sino también un punto de partida para otras aventuras. Desde aquí, los viajeros pueden visitar el Cañón del Colca, uno de los más profundos del mundo, donde se pueden observar majestuosos cóndores en su hábitat natural. Además, la gastronomía arequipeña, famosa por platos como el rocoto relleno y el chupe de camarones, es otro de los grandes atractivos que hacen de esta ciudad un destino inolvidable.', 'Arequipa', 160.00, '../../assets/img/destination_monasterio_santa_catalina.webp', 1),
('Montaña Vinicunca', 'La Montaña Vinicunca, conocida mundialmente como la Montaña de Siete Colores, es un espectáculo natural que parece salido de un cuadro surrealista. Ubicada en los Andes peruanos a más de 5,000 metros sobre el nivel del mar, esta maravilla geológica debe sus colores vibrantes a la composición mineral del suelo. Desde el rosa hasta el verde y el amarillo, cada tonalidad cuenta una historia milenaria del origen de los Andes.

Para llegar a Vinicunca, los visitantes deben emprender una caminata que atraviesa paisajes montañosos y valles profundos. Aunque el ascenso es desafiante debido a la altitud, el esfuerzo es recompensado con vistas panorámicas impresionantes y una conexión única con la naturaleza. Durante el recorrido, es común encontrarse con alpacas, llamas y comunidades locales que comparten su cultura y estilo de vida ancestral.

Vinicunca no solo es un destino turístico, sino también un lugar espiritual para las comunidades indígenas que consideran esta montaña sagrada. Los visitantes tienen la oportunidad de aprender sobre las tradiciones andinas y de contribuir al turismo sostenible, respetando el entorno y apoyando a las comunidades locales. Es, sin duda, una experiencia que combina aventura, cultura y un profundo respeto por la naturaleza.', 'Cusco', 150.00, '../../assets/img/destination_montana_vinicunca.webp', 3),
('Isla Taquile', 'La Isla Taquile, en el corazón del Lago Titicaca, es un refugio de tranquilidad y tradiciones andinas. Sus habitantes, conocidos por su excepcional habilidad en la confección textil, han mantenido vivas sus costumbres durante siglos. La UNESCO ha reconocido su arte textil como Patrimonio Cultural Inmaterial de la Humanidad, y los visitantes pueden aprender sobre su proceso de creación mientras disfrutan de las impresionantes vistas del lago y las montañas circundantes.

Un recorrido por Taquile es una experiencia cultural y espiritual. La isla está libre de vehículos, lo que permite una conexión más profunda con la naturaleza. Los turistas pueden caminar por sus senderos, visitar sus templos y plazas, y disfrutar de platos locales como la trucha del lago. La hospitalidad de los habitantes y su estilo de vida tradicional hacen de Taquile un destino único en el Perú.
', 'Puno', 80.00, '../../assets/img/destination_isla_taquile.webp', 3),
('Chavín de Huántar', 'Chavín de Huántar es un sitio arqueológico que ofrece una fascinante mirada a la civilización Chavín, una de las culturas más antiguas de los Andes. Este complejo religioso, que data de aproximadamente el año 900 a.C., es conocido por sus intrincados sistemas de túneles y galerías subterráneas. Entre sus reliquias más famosas se encuentra la "Cabeza Clava" y el "Lanzón Monolítico", que revelan el simbolismo y la espiritualidad de esta cultura preincaica.

Explorar Chavín es como retroceder en el tiempo. Los visitantes pueden recorrer sus plazas ceremoniales y aprender sobre los rituales que se llevaban a cabo en este centro de culto. Además, el entorno montañoso y el río que atraviesa la zona complementan la experiencia, haciendo de Chavín un lugar imprescindible para los amantes de la historia y la arqueología.', 'Áncash', 120.00, '../../assets/img/destination_chavin_de_huantar.webp', 7),
('Reserva Nac. Pacaya Samiria', 'La Reserva Nacional Pacaya Samiria, ubicada en la selva amazónica de Loreto, es un paraíso para los amantes de la biodiversidad. Conocida como la "selva de los espejos" por los reflejos de sus ríos, esta área protegida alberga una increíble variedad de flora y fauna, incluyendo delfines rosados, jaguares, manatíes y cientos de especies de aves. Es el lugar ideal para adentrarse en la selva y experimentar la riqueza de la Amazonía peruana.

Las actividades en Pacaya Samiria incluyen paseos en bote, caminatas guiadas y visitas a comunidades locales que comparten su conocimiento ancestral de la selva. Los turistas pueden aprender sobre el uso sostenible de los recursos naturales y participar en proyectos de conservación. Este destino ofrece una experiencia única de conexión con la naturaleza y la cultura amazónica.', 'Loreto', 300.00, '../../assets/img/destination_pacaya_samiria.webp', 3),
('Kuélap', 'La fortaleza de Kuélap, construida por la cultura Chachapoya, es una joya arqueológica ubicada en lo alto de una montaña en la región Amazonas. Rodeada de un imponente muro de piedra, Kuélap fue un importante centro político y religioso. Sus estructuras, que incluyen viviendas circulares y templos, están envueltas en un halo de misterio que fascina a los visitantes.

Además de su riqueza histórica, Kuélap ofrece vistas espectaculares de los valles y montañas circundantes. Llegar a este sitio implica una emocionante travesía, ya sea en teleférico o por senderos que atraviesan bosques nubosos. La combinación de historia, aventura y paisajes impresionantes hace de Kuélap un destino imprescindible en el norte del Perú.', 'Amazonas', 200.00, '../../assets/img/destination_kuelap.webp', 7),
('Cataratas de Gocta', 'Las Cataratas de Gocta, con más de 700 metros de altura, son una de las cascadas más impresionantes del mundo. Escondida entre la selva de la región Amazonas, esta maravilla natural se descubrió para el turismo hace relativamente poco, lo que añade un aire de misterio a su encanto. El sonido del agua cayendo y la exuberante vegetación que la rodea crean un ambiente mágico.

Para llegar a Gocta, los visitantes deben realizar una caminata que atraviesa paisajes de montaña, riachuelos y pequeñas comunidades. Durante el trayecto, es posible avistar aves como el gallito de las rocas y monos aulladores. Esta experiencia combina aventura, naturaleza y un encuentro único con la majestuosidad de la selva peruana.', 'Amazonas', 100.00, '../../assets/img/destination_cataratas_de_gocta.webp', 5),
('Chan Chan', 'Chan Chan, la ciudad de barro más grande de América, es un legado de la civilización Chimú. Este sitio arqueológico, ubicado en la costa norte del Perú, es un testimonio del ingenio arquitectónico precolombino. Sus murallas decoradas con motivos marinos y geométricos reflejan la estrecha relación de esta cultura con el mar.

Recorrer Chan Chan es como adentrarse en una ciudad fantasma que aún conserva su grandeza. Sus plazas ceremoniales, depósitos y templos ofrecen una visión única de la vida en esta antigua metrópoli. El contraste entre el desierto costero y las imponentes estructuras de barro hace de este lugar una experiencia inolvidable.', 'La Libertad', 140.00, '../../assets/img/destination_chan_chan.webp', 7),
('Huacachina', 'Huacachina, un oasis en medio del desierto de Ica, es uno de los paisajes más singulares del Perú. Rodeado de dunas doradas y palmeras, este pequeño pueblo es un destino perfecto para los amantes de la aventura. Aquí, los visitantes pueden practicar sandboarding, deslizarse por las dunas en tablas, o recorrer el desierto en buggies, disfrutando de atardeceres espectaculares.

Además de las actividades de aventura, Huacachina ofrece un ambiente relajado para quienes buscan descansar y disfrutar del paisaje. Su laguna central, envuelta en leyendas locales, añade un toque místico a este lugar. La combinación de adrenalina, naturaleza y tranquilidad hace de Huacachina un destino único en el Perú.', 'Ica', 90.00, '../../assets/img/destination_huacachina.webp', 3);

INSERT INTO ProgrammedTrips (Name, Description, StartDate, EndDate, MaxCapacity, Price, DestinationID) VALUES 
('Tour Machu Picchu Básico', 'Incluye visita guiada y transporte en tren desde Cusco.', '2024-12-01', '2024-12-02', 30, 350.00, 1),
('Sobrevuelo Líneas de Nazca', 'Experiencia inolvidable para admirar los misteriosos geoglifos.', '2024-11-30', '2024-11-30', 15, 200.00, 2),
('Aventura en Paracas', 'Incluye paseo en bote a las Islas Ballestas y visita a la Reserva Nacional de Paracas.', '2024-12-10', '2024-12-11', 25, 150.00, 3),
('Trekking Laguna Humantay', 'Caminata guiada con vistas espectaculares de la laguna y el nevado.', '2024-12-05', '2024-12-05', 20, 100.00, 4),
('Exploración del Cañón del Colca', 'Incluye trekking, observación de cóndores y visitas a pueblos tradicionales.', '2024-12-15', '2024-12-16', 20, 220.00, 5);

INSERT INTO PaymentMethods (Name, Description) VALUES 
('Tarjeta de Crédito', 'Pago mediante tarjetas Visa, Mastercard o American Express.'),
('Transferencia Bancaria', 'Pago directo a través de cuentas bancarias peruanas.'),
('Pago en Efectivo', 'Pago realizado en nuestras oficinas o puntos autorizados.');

INSERT INTO Activities (Name, Description, Price) VALUES 
('Caminata al amanecer', 'Trekking temprano para disfrutar del amanecer en los Andes.', 30.00),
('Tour en bote', 'Paseo en bote por las aguas del Pacífico.', 50.00),
('Clase de cocina peruana', 'Aprende a preparar platos tradicionales como ceviche y lomo saltado.', 70.00),
('Observación de cóndores', 'Avistamiento de cóndores en su hábitat natural.', 40.00),
('Exploración arqueológica', 'Visita guiada a ruinas menos conocidas.', 60.00),
('Avistamiento de Delfines Rosados', 'Experimenta la magia de observar delfines rosados en su hábitat natural mientras navegas por el río Amazonas.', 50.00),
('Visita Guiada a Chavín de Huántar', 'Explora las galerías y monumentos de Chavín de Huántar acompañado de un guía experto.', 25.00),
('Caminata al Mirador de Kuélap', 'Disfruta de un recorrido escénico hacia el mirador de la fortaleza de Kuélap, con vistas panorámicas del valle.', 30.00),
('Sandboarding en Huacachina', 'Deslízate por las dunas de Huacachina en una experiencia llena de adrenalina.', 40.00),
('Paseo en Buggy por el Desierto', 'Recorre las dunas de Huacachina a bordo de buggies especializados.', 45.00),
('Taller de Artesanías en Taquile', 'Aprende las técnicas tradicionales de tejido de los habitantes de la Isla Taquile.', 20.00),
('Caminata a las Cataratas de Gocta', 'Adéntrate en la selva para descubrir las imponentes Cataratas de Gocta.', 35.00),
('Tour Arqueológico en Chan Chan', 'Descubre los secretos de la ciudad de barro más grande de América acompañado de expertos locales.', 20.00),
('Observación de Aves en Pacaya Samiria', 'Avista especies únicas en la Reserva Nacional Pacaya Samiria, como el gallito de las rocas y guacamayos.', 50.00),
('Paseo en Caballo a Vinicunca', 'Disfruta de un recorrido a caballo hacia la Montaña de Siete Colores, ideal para los que buscan una alternativa a la caminata.', 60.00),
('Tour en Totora por el Lago Titicaca', 'Recorrido en bote tradicional de totora por el Lago Titicaca, explorando sus islas flotantes y aprendiendo sobre las costumbres locales.', 40.00),
('Visita Guiada al Monasterio de Santa Catalina', 'Recorrido guiado por el Monasterio de Santa Catalina, un complejo histórico con hermosos claustros y arquitectura colonial, conociendo la historia religiosa de Arequipa.', 25.00);

INSERT INTO Destination_Activities (DestinationID, ActivityID) VALUES 
(1, 1), -- Caminata en Machu Picchu
(2, 3), -- Clase de cocina peruana en Nazca
(3, 2), -- Tour en bote en Paracas
(4, 5), -- Exploración arqueológica en la Laguna Humantay
(5, 4), -- Observación de cóndores en el Colca
(6, 16),
(7, 17),
(8, 15),
(9, 11),
(10, 7),
(11, 6),
(11, 14),
(12, 8),
(13, 12),
(14, 13),
(15, 9),
(15, 10);


/* INSERT INTO Reservations (ProgrammedTripID, UserID, PhoneNumber, NumberPeople, State) VALUES 
(1, 1, '987654321', 2, 'confirmada'), 
(3, 2, '987123456', 4, 'pendiente'), 
(5, 3, '975312468', 1, 'cancelada');

INSERT INTO Payments (ReservationID, PaymentMethodID, TotalAmount) VALUES 
(1, 1, 700.00), -- Pago con tarjeta
(2, 2, 600.00); -- Pago con transferencia */