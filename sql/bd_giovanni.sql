DROP DATABASE IF EXISTS problemario;
CREATE DATABASE problemario CHARACTER SET utf8 COLLATE utf8_general_ci;
USE problemario;

CREATE TABLE ueas (
   id INT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(64) NOT NULL,
   orden INT NOT NULL DEFAULT 0,
   
   PRIMARY KEY (id),
   UNIQUE (nombre)
) ENGINE=InnoDB;

CREATE TABLE temas (
   id INT NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(64) NOT NULL,
   uea INT NOT NULL,
   orden INT NOT NULL DEFAULT 0,
   
   PRIMARY KEY (id),
   UNIQUE (nombre, uea),
   FOREIGN KEY (uea) REFERENCES ueas (id)
) ENGINE=InnoDB;

CREATE TABLE problemas (
   id INT NOT NULL AUTO_INCREMENT,
   alias VARCHAR(32) NOT NULL,
   nombre TEXT NOT NULL,
   tema INT NOT NULL,
   orden INT NOT NULL DEFAULT 0,
   
   PRIMARY KEY (id),
   UNIQUE (alias),
   FOREIGN KEY (tema) REFERENCES temas (id)
) ENGINE=InnoDB;

CREATE TABLE tags (
   id INT NOT NULL AUTO_INCREMENT,
   clave VARCHAR(75) NOT NULL,
   traduccion TEXT NOT NULL,
   orden INT NOT NULL DEFAULT 0,
   
   PRIMARY KEY (id),
   UNIQUE (clave)
) ENGINE=InnoDB;

CREATE TABLE tags_problema (
   problema INT NOT NULL,
   tag INT NOT NULL,
   
   UNIQUE (problema, tag),
   FOREIGN KEY (problema) REFERENCES problemas (id),
   FOREIGN KEY (tag) REFERENCES tags (id)
) ENGINE=InnoDB;

INSERT INTO ueas (nombre) VALUES
	("Programación Estructurada"),
	("Algoritmos y Estructuras de Datos"),
	("Almacenamiento y Estructuras de Archivos"),
	("Análisis y Diseño de Algoritmos"),
	("Inteligencia artificial"),
	("Inteligencia computacional"),
	("Big Data"),
	("Combinatoria"),
	("Compiladores"),
	("Criptografía"),
	("Taller de Análisis y Diseño de Algoritmos"),
   ("Otros cursos");

INSERT INTO temas (nombre, uea) VALUES
   ("Sin clasificación",    (SELECT id FROM ueas WHERE nombre = "Programación Estructurada")),
   ("Entrada y salida",     (SELECT id FROM ueas WHERE nombre = "Programación Estructurada")),
   ("Cálculos aritméticos", (SELECT id FROM ueas WHERE nombre = "Programación Estructurada")),
   ("Toma de decisiones", 	 (SELECT id FROM ueas WHERE nombre = "Programación Estructurada")),
   ("Ciclos", 				    (SELECT id FROM ueas WHERE nombre = "Programación Estructurada")),
   ("Arreglos", 			    (SELECT id FROM ueas WHERE nombre = "Programación Estructurada")),
   ("Matrices", 			    (SELECT id FROM ueas WHERE nombre = "Programación Estructurada")),
   ("Caracteres y cadenas", (SELECT id FROM ueas WHERE nombre = "Programación Estructurada")),
   ("Estructuras", 			 (SELECT id FROM ueas WHERE nombre = "Programación Estructurada")),
   ("Entrada y salida con presentación", (SELECT id FROM ueas WHERE nombre = "Programación Estructurada")),
   
   ("Sin clasificación",	    (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   ("Algoritmia y eficiencia", (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   ("Recursión",			       (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   ("Ordenamiento", 		       (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   ("Búsqueda binaria", 	    (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   ("Memoria dinámica", 	    (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   ("Pilas y colas", 		    (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   ("Listas enlazadas", 	    (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   ("Montículos", 			    (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   ("Árboles de búsqueda",     (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   ("Gráficas", 			       (SELECT id FROM ueas WHERE nombre = "Algoritmos y Estructuras de Datos")),
   
   ("Sin clasificación",                (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Almacenamiento primario y cachés", (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Dispersión",                       (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Entrada y salida sin formato",     (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Almacenamiento externo",           (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Posicionamiento en archivos",      (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Fragmentación de datos",           (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Ordenamiento externo",             (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Búsqueda externa",                 (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Manipulación de cadenas",          (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Compresión de datos",              (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   ("Mantenimiento de registros y compactación", (SELECT id FROM ueas WHERE nombre = "Almacenamiento y Estructuras de Archivos")),
   
   ("Sin clasificación",                     (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   ("Análisis de correctitud y complejidad", (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   ("Recursión y ecuaciones de recurrencia", (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   ("Divide y vencerás",                     (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   ("Búsqueda con retroceso",                (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   ("Recursión con memorización",            (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   ("Programación dinámica",                 (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   ("Búsqueda en amplitud",                  (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   ("Búsqueda local",                        (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   ("Algoritmos glotones",                   (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   ("Problemas NP-Completos",                (SELECT id FROM ueas WHERE nombre = "Análisis y Diseño de Algoritmos")),
   
   ("Sin clasificación", (SELECT id FROM ueas WHERE nombre = "Inteligencia artificial")),
   
   ("Sin clasificación", (SELECT id FROM ueas WHERE nombre = "Inteligencia computacional")),
   
   ("Sin clasificación", (SELECT id FROM ueas WHERE nombre = "Big Data")),
   
   ("Sin clasificación", (SELECT id FROM ueas WHERE nombre = "Combinatoria")),
   
   ("Sin clasificación", (SELECT id FROM ueas WHERE nombre = "Compiladores")),
   
   ("Sin clasificación", (SELECT id FROM ueas WHERE nombre = "Criptografía")),
   
   ("Sin clasificación", (SELECT id FROM ueas WHERE nombre = "Taller de Análisis y Diseño de Algoritmos")),
   
   ("Sin clasificación", (SELECT id FROM ueas WHERE nombre = "Otros cursos"));
   
INSERT INTO tags (clave, traduccion) VALUES  
   ("problemTagInputAndOutput", "Entrada y salida"),
	("problemTagArithmetic", "Cálculos aritméticos"),
	("problemTagConditionals", "Toma de decisiones"),
	("problemTagLoops", "Ciclos"),
	("problemTagArrays", "Arreglos"),
	("problemTagMatrices", "Matrices"),
	("problemTagCharsAndStrings", "Caracteres y cadenas"),
	("problemTagFormattedInputAndOutput", "Entrada y salida con presentación"),
	("problemTagImplementation", "Implementación"),
	("problemTagBruteForce", "Fuerza bruta"),
	("problemTagRecursion", "Recursión"),
	("problemTagExponentiationBySquaring", "Exponenciación binaria"),
	("problemTagSorting", "Ordenamiento"),
	("problemTagBinarySearch", "Búsqueda binaria"),
	("problemTagExponentialSearch", "Salto exponencial"),
	("problemTagStacks", "Pilas"),
	("problemTagQueues", "Colas"),
	("problemTagLinkedLists", "Listas enlazadas"),
	("problemTagInvertedIndices", "Índices invertidos"),
	("problemTagHeaps", "Montículos"),
   ("problemTagSetsMultisets", "Conjuntos y multiconjuntos"),
	("problemTagBinarySearchTree", "Árboles binarios de búsqueda"),
	("problemTagTreeTransversal", "Recorridos en árboles"),
	("problemTagGraphRepresentation", "Representación de gráficas"),
	("problemTagGraphConnectivity", "Conexidad en gráficas"),
	("problemTagDirectedGraphs", "Gráficas dirigidas"),
	("problemTagGraphsWithNegativeWeights", "Gráficas con pesos negativos"),
	("problemTagShortestPaths", "Caminos más cortos"),
	("problemTagMinimumSpanningTrees", "Árboles abarcadores"),
	("problemTagTopologicalSorting", "Ordenamiento topológico"),
	("problemTagDisjointSets", "Conjuntos disjuntos"),
	("problemTagBitManipulation", "Manipulación de bits"),
	("problemTagDataCompression", "Compresión de datos"),
	("problemTagBigData", "Procesamiento de datos masivos"),
	("problemTagBreadthFirstSearch", "Búsqueda en amplitud"),
	("problemTagDepthFirstSearch", "Búsqueda en profundidad"),
	("problemTagBacktracking", "Búsqueda con retroceso"),
	("problemTagLocalSearch", "Búsqueda local"),
	("problemTagMemorization", "Memorización"),
	("problemTagGreedyAlgorithms", "Algoritmos glotones"),
	("problemTagDivideAndConquer", "Divide y vencerás"),
	("problemTagDynamicProgramming", "Programación dinámica"),
	("problemTagMeetInTheMiddle", "Método de las dos mitades"),
	("problemTagSubArraySearch", "Búsqueda de subarreglos"),
	("problemTagStringMatching", "Búsqueda de subcadenas"),
	("problemTagSubsequenceSearch", "Búsqueda de subsecuencias"),
	("problemTagPalindromeAlgorithms", "Palíndromos"),
	("problemTagAnalyticGeometry", "Geometría analítica"),
	("problemTagSystemsOfEquations", "Sistemas de ecuaciones"),
	("problemTagGCDAndLCM", "Múltiplos y divisores comunes"),
	("problemTagModularArithmetic", "Aritmética modular"),
	("problemTagModularMultiplicativeInverse", "Inverso modular"),
	("problemTagPermutations", "Permutaciones"),
	("problemTagCombinations", "Combinaciones"),
	("problemTagDivisibilityRules", "Reglas de divisibilidad"),
	("problemTagCountingProblems", "Problemas de conteo"),
	("problemTagCombinatorialDesigns", "Diseños combinatorios"),
	("problemTagGameTheory", "Teoría de juegos"),
	("problemTagNumberTheory", "Teoría de números"),
	("problemTagPrimalityTest", "Pruebas de primalidad"),
	("problemTagPrimeGeneration", "Generación de primos"),
	("problemTagPrimeFactorization", "Factorización prima"),
	("problemTagFourierTransformation", "Transformada de Fourier"),
	("problemTagBooleanAlgebra", "Lógica y álgebra booleana"),
	("problemTagBigNumbers", "Números grandes"),
	("problemTagConvexHull", "Cerco convexo"),
	("problemTagNearestNeighbors", "Vecinos más cercanos"),
	("problemTagProbabilityAndStatistics", "Probabilidad y estadística"),
	("problemTagSlidingWindow", "Ventana deslizante"),
	("problemTagSegmentTrees", "Árboles de segmentos"),
	("problemTagTries", "Árboles de prefijos"),
	("problemTagSuffixTrees", "Árboles de sufijos"),
	("problemTagFenwickTrees", "Árboles de Fenwick"),
	("problemTagSQRTDecomposition", "Descomposición SQRT"),
	("problemTagLazyPropagation", "Evaluación perezosa"),
	("problemTagOfflineQueries", "Peticiones fuera de línea"),
	("problemTagBipartiteMatching", "Acoplamiento bipartito"),
	("problemTagMaxFlow", "Flujo máximo"),
	("problemTagLexingAndParsing", "Análisis léxico-sintáctico"),
	("problemTagHeuristics", "Heurísticas"),
	("problemTagPartialSums", "Acumulación parcial"),
	("problemTagAnalysisOfRecurrences", "Análisis de recurrencias"),
	("problemTagUnformattedInputAndOutput", "Entrada y salida sin formato"),
	("problemTagFileSeeking", "Posicionamiento en archivos"),
	("problemTagTrees", "Gráficas acíclicas (árboles)"),
	("problemTagGeneticAlgorithms", "Algoritmos genéticos"),
	("problemTagLeastCommonAncestor", "Ancestro común en árboles"),
	("problemTagSweepLine", "Barrido del plano"),
	("problemTagIncrementalSearch", "Búsqueda incremental"),
	("problemTagHashing", "Dispersión"),
	("problemTagDiophantineEquations", "Ecuaciones diofánticas"),
	("problemTagFunctions", "Funciones"),
	("problemTagParticleSwarmOptimization", "Optimización de partículas"),
	("problemTagMonotoneStack", "Pila monótona"),
	("problemTagNumericalSeries", "Series numéricas"),
	("problemTagSimulation", "Simulación"),
	("problemTagChineseRemainderTheorem", "Teorema chino del residuo"),
	("problemTagTwoPointersTechnique", "Técnica de dos apuntadores"),
	("problemTagWaveletTrees", "Árboles Wavelet"),
	("problemTagLinearSearch", "Búsqueda lineal");
