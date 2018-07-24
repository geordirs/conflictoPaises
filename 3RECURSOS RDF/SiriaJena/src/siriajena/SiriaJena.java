 /*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package siriajena;

import java.io.BufferedReader;
import org.apache.jena.rdf.model.Model;
import org.apache.jena.rdf.model.ModelFactory;
import org.apache.jena.rdf.model.Property;
import org.apache.jena.rdf.model.RDFNode;
import org.apache.jena.rdf.model.Resource;
import org.apache.jena.rdf.model.Statement;
import org.apache.jena.rdf.model.StmtIterator;
import org.apache.jena.vocabulary.RDF;
import org.apache.jena.vocabulary.RDFS;
import org.apache.jena.vocabulary.VCARD;
import org.apache.jena.sparql.vocabulary.FOAF;
import org.apache.jena.rdf.model.RDFWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.util.Scanner;
import org.apache.jena.ontology.DatatypeProperty;
import org.apache.jena.ontology.ObjectProperty;
import org.apache.jena.ontology.OntModelSpec;
import org.apache.jena.vocabulary.DC;
import org.apache.jena.datatypes.xsd.XSDDatatype;
import org.apache.jena.ontology.OntModel;
import org.apache.jena.ontology.OntModelSpec;
import org.apache.jena.rdf.model.Literal;

/**
 *
 * @author geordi
 */
public class SiriaJena {

    public static void main(String[] args) throws FileNotFoundException {
        //create an empty Model
        Model model = ModelFactory.createDefaultModel();
        //Fijar ruta del archivo RDF
        File f = new File("C:/Users/Giorgio/Documents/giorgio/SBC/SBC_Conflicto/3RECURSOS RDF/RDF/conflicto2.rdf"); 
        FileOutputStream os = new FileOutputStream(f);
        BufferedReader br = null;
        BufferedReader br1 = null;
        BufferedReader br2 = null;
        BufferedReader br3 = null;
        BufferedReader br4 = null;
        BufferedReader br5 = null;
        BufferedReader br6 = null;

        Resource gov = null;
        Resource ccountry = null;
        Resource conflict = null;
        Resource grupo = null;
        Resource martir = null;
        Resource reg_martir = null;
        Resource detenido = null;
        Resource reg_detenido = null;
        Resource desaparecido = null;
        Resource reg_desaparecido = null;
        Resource ataque = null;
        Resource sourceMedia = null;

        //PREFIJO DE URI BASE PARA LAS --- CLASES ---
        String schemaPrefix = "http://conflictosiria.com/schema/";
        model.setNsPrefix("schemaSiria", schemaPrefix);

        //Fijar Prefijo para URI base de los datos a crear 
        String dataPrefix = "http://conflictosiria.com/data/";
        model.setNsPrefix("dataSiria", dataPrefix);

        //Fijar Prefijos de vocabularios incorporados en Jena
        String foaf = "http://xmlns.com/foaf/0.1/";
        model.setNsPrefix("foaf", foaf);

        String dbo = "http://dbpedia.org/ontology/";
        model.setNsPrefix("dbo", dbo);
        Model dboModel = ModelFactory.createDefaultModel(); // MODELO PARA LA ONTOLOGIA
        dboModel.read(dbo);

        String geo = "http://www.w3.org/2003/01/geo/wgs84_pos#";
        model.setNsPrefix("geo", geo);
        Model geoModel = ModelFactory.createDefaultModel(); // MODELO PARA LA ONTOLOGIA
        dboModel.read(geo);

        //IMPORTAR MODELO PROTEGE .owl
        OntModel myModel = ModelFactory.createOntologyModel(OntModelSpec.OWL_MEM);
        myModel.read("C:/Users/Giorgio/Documents/giorgio/SBC/SBC_Conflicto/2ONTOLOGIA/ontologia2.owl", "RDF/XML");

        boolean var = false;
        
        try {
            
            if (var == false) {
            
            //SOURCE MEDIA - MEDIOS DE COMUNICACIÓN
            br6 = new BufferedReader(new FileReader("C:/Users/Giorgio/Documents/giorgio/SBC/SBC_Conflicto/1FUENTES DE DATOS/medios_comunicacion.csv"));
            String line6;
            br6.readLine();
            while ((line6 = br6.readLine()) != null) {
                String[] data6 = line6.split(",");
                String medio_com = data6[0].replaceAll("\\s+", "").replaceAll("\"", "");
                sourceMedia = model.createResource(dataPrefix + medio_com)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "SourceMedia"))
                        .addProperty(FOAF.name, model.createLiteral(data6[0].replaceAll("\"", ""), "es"))
                        .addProperty(FOAF.homepage, model.createLiteral(data6[1].replaceAll("\"", ""), "es"));
            }

            //ATAQUE - ASALTO
            br5 = new BufferedReader(new FileReader("C:/Users/Giorgio/Documents/giorgio/SBC/SBC_Conflicto/1FUENTES DE DATOS/ataques.csv"));
            String line5;
            br5.readLine();
            while ((line5 = br5.readLine()) != null) {
                String[] data5 = line5.split(",");
                
                //Añadir url
                String sourceURI = data5[4].replaceAll("\\s+", "").replaceAll("\"", "");
                ataque = model.createResource(dataPrefix + sourceURI)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "Source"))
                        .addProperty(RDF.type, dataPrefix + data5[7].replaceAll(" ", ""))
                        .addProperty(dboModel.getProperty(dbo + "title"), model.createLiteral(data5[5].replaceAll("\"", ""), "es"));
                        
                
                String ataqueURI = "assault" + data5[0];
                ataque = model.createResource(dataPrefix + ataqueURI)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "Assault"))
                        .addProperty(myModel.getProperty(schemaPrefix + "attackDate"), model.createTypedLiteral(data5[1], XSDDatatype.XSDdate))
                        .addProperty(myModel.getProperty(schemaPrefix + "befallAttack"), dataPrefix + data5[6].replaceAll(" ", ""))
                        .addProperty(myModel.getProperty(schemaPrefix + "startedBy"), dataPrefix + data5[2].replaceAll(" ", ""))
                        .addProperty(myModel.getProperty(schemaPrefix + "target"), dataPrefix + data5[3].replaceAll(" ", ""))
                        .addProperty(myModel.getProperty(schemaPrefix + "reportedBy"), dataPrefix + sourceURI);
            }

            //PROVINCIAS
            br = new BufferedReader(new FileReader("C:/Users/Giorgio/Documents/giorgio/SBC/SBC_Conflicto/1FUENTES DE DATOS/provincias.csv"));
            String line;
            br.readLine();
            while ((line = br.readLine()) != null) {
                //PROVINCIAS - GOBERNACIONES
                String[] data = line.split(",");
                String governorateURI = data[0].replaceAll("\\s+", "").replaceAll("\"", "");
                gov = model.createResource(dataPrefix + governorateURI)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "Governorate"))
                        .addProperty(dboModel.getProperty(dbo + "province"), model.createLiteral(data[0].replaceAll("\"", ""), "es"))
                        .addProperty(dboModel.getProperty(dbo + "abstract"), model.createLiteral(data[1].replaceAll("\"", ""), "es"))
                        .addProperty(geoModel.getProperty(geo + "lat"), model.createTypedLiteral(data[2], XSDDatatype.XSDfloat))
                        .addProperty(geoModel.getProperty(geo + "long"), model.createTypedLiteral(data[3], XSDDatatype.XSDfloat));
                        

                //PAIS DE CONFLICTO
                String cc = "Siria";
                ccountry = model.createResource(dataPrefix + cc)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "ConflictCountry"))
                        .addProperty(dboModel.getProperty(dbo + "country"), model.createLiteral(cc, "es"))
                        .addProperty(dboModel.getProperty(geo + "abstract"), model.createLiteral("Es un país soberano del Oriente Próximo, en la costa oriental mediterránea, cuya forma de gobierno es la república unitaria semipresidencialista, actualmente sumida en la Guerra Civil Siria desde hace más de cuatro años.", "es"))
                        .addProperty(myModel.getProperty(schemaPrefix + "territorialDivision"), gov);

                //CONFLICTO
                String conflictoURI = "Guerra Civil Siria";

                conflict = model.createResource(dataPrefix + conflictoURI.replaceAll("\\s+", "").replaceAll("\"", ""))
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "Conflict"))
                        .addProperty(dboModel.getProperty(dbo + "abstract"), model.createLiteral("Es un conflicto bélico iniciado a principios de 2011 y que se desarrolla en la actualidad en el país de Siria", "es"))
                        .addProperty(myModel.getProperty(schemaPrefix + "occur"), ccountry);
            }

            //GRUPO ARMADO
            br1 = new BufferedReader(new FileReader("C:/Users/Giorgio/Documents/giorgio/SBC/SBC_Conflicto/1FUENTES DE DATOS/grupo_armado.csv"));
            String line1;
            br1.readLine();
            while ((line1 = br1.readLine()) != null) {
                String[] data1 = line1.split(",");
                String grupoArmadoURI = data1[0].replaceAll("\\s+", "").replaceAll("\"", "");
                grupo = model.createResource(dataPrefix + grupoArmadoURI)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "ArmedGroup"))
                        .addProperty(FOAF.name, model.createLiteral(data1[0].replaceAll("\"", ""), "es"))
                        .addProperty(dboModel.getProperty(dbo + "abstract"), model.createLiteral(data1[1].replaceAll("\"", ""), "es"))
                        .addProperty(myModel.getProperty(schemaPrefix + "intervenes"), conflict);
            }

            //Registro de Detenciones
            br2 = new BufferedReader(new FileReader("C:/Users/Giorgio/Documents/giorgio/SBC/SBC_Conflicto/1FUENTES DE DATOS/detenidos.csv"));
            String line2;
            br2.readLine();
            while ((line2 = br2.readLine()) != null) {
                String[] data2 = line2.split(",");
                String reg_detenidoURI = "detained" + data2[0];
                reg_detenido = model.createResource(dataPrefix + reg_detenidoURI)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "Detention"))
                        .addProperty(dboModel.getProperty(dbo + "arrestDate"), model.createTypedLiteral(data2[2], XSDDatatype.XSDdate))
                        .addProperty(myModel.getProperty(schemaPrefix + "criminalRecord"), model.createLiteral(data2[6].replaceAll("\"", ""), "es"));

                //DETENIDOS
                String detenidosURI = data2[5].replaceAll("\\s+", "").replaceAll("\"", "");
                detenido = model.createResource(dataPrefix + detenidosURI)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "Victim"))
                        .addProperty(FOAF.name, model.createLiteral(data2[5].replaceAll("\"", ""), "es"))
                        .addProperty(FOAF.gender, model.createLiteral(data2[1].replaceAll("\"", ""), "es"))
                        .addProperty(myModel.getProperty(schemaPrefix + "livesIn"), dataPrefix + data2[3].replaceAll(" ", ""))
                        .addProperty(myModel.getProperty(schemaPrefix + "registeredIn"), dataPrefix + reg_detenidoURI);
            }

            //Registro de Fallecimientos
            br3 = new BufferedReader(new FileReader("C:/Users/Giorgio/Documents/giorgio/SBC/SBC_Conflicto/1FUENTES DE DATOS/martires.csv"));
            String line3;
            br3.readLine();
            while ((line3 = br3.readLine()) != null) {
                String[] data3 = line3.split(",");
                String reg_martirURI = "martyr" + data3[0];
                reg_martir = model.createResource(dataPrefix + reg_martirURI)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "Decease"))
                        .addProperty(myModel.getProperty(schemaPrefix + "deathCause"), model.createLiteral(data3[8].replaceAll("\"", ""), "es"))
                        .addProperty(dboModel.getProperty(dbo + "deathDate"), model.createTypedLiteral(data3[2], XSDDatatype.XSDdate))
                        .addProperty(myModel.getProperty(schemaPrefix + "citizenType"), model.createLiteral(data3[5].replaceAll("\"", ""), "es"));

                //MARTIRES (muertos)
                String martirURI = data3[7].replaceAll("\\s+", "").replaceAll("\"", "");
                martir = model.createResource(dataPrefix + martirURI)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "Victim"))
                        .addProperty(FOAF.name, model.createLiteral(data3[7].replaceAll("\"", ""), "es"))
                        .addProperty(FOAF.gender, model.createLiteral(data3[3].replaceAll("\"", ""), "es"))
                        .addProperty(myModel.getProperty(schemaPrefix + "livesIn"), dataPrefix + data3[4].replaceAll(" ", ""))
                        .addProperty(myModel.getProperty(schemaPrefix + "registeredIn"), dataPrefix + reg_martirURI);
            }

            //Registro de Desapariciones
            br4 = new BufferedReader(new FileReader("C:/Users/Giorgio/Documents/giorgio/SBC/SBC_Conflicto/1FUENTES DE DATOS/desaparecidos.csv"));
            String line4;
            br4.readLine();
            while ((line4 = br4.readLine()) != null) {
                String[] data4 = line4.split(",");
                String reg_desaparecidoURI = "missing" + data4[0];
                reg_desaparecido = model.createResource(dataPrefix + reg_desaparecidoURI)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "Disapperance"))
                        .addProperty(myModel.getProperty(schemaPrefix + "disapperanceDate"), model.createTypedLiteral(data4[4], XSDDatatype.XSDdate))
                        .addProperty(myModel.getProperty(schemaPrefix + "foundDate"), model.createTypedLiteral(data4[6].replaceAll("\"", "") , XSDDatatype.XSDdate));

                //DEsaparecidos
                String desaparecidosURI = data4[5].replaceAll("\\s+", "").replaceAll("\"", "");
                desaparecido = model.createResource(dataPrefix + desaparecidosURI)
                        .addProperty(RDF.type, myModel.getResource(schemaPrefix + "Victim"))
                        .addProperty(FOAF.name, model.createLiteral(data4[5].replaceAll("\"", ""), "es"))
                        .addProperty(FOAF.gender, model.createLiteral(data4[2].replaceAll("\"", ""), "es"))
                        .addProperty(myModel.getProperty(schemaPrefix + "livesIn"), dataPrefix + data4[1].replaceAll(" ", ""))
                        .addProperty(myModel.getProperty(schemaPrefix + "registeredIn"), dataPrefix + reg_desaparecidoURI);
            }

            //RELACIONES
            model.add(myModel.getResource(schemaPrefix + "Conflict"), RDFS.subClassOf, dboModel.getResource(dbo + "MilitaryConflict"));
            model.add(myModel.getResource(schemaPrefix + "ConflictCountry"), RDFS.subClassOf, dboModel.getResource(dbo + "Country"));
            model.add(myModel.getResource(schemaPrefix + "Victim"), RDFS.subClassOf, FOAF.Person);
            model.add(myModel.getResource(schemaPrefix + "ArmedGroup"), RDFS.subClassOf, FOAF.Organization);
            model.add(myModel.getResource(schemaPrefix + "Assault"), RDFS.subClassOf, dboModel.getResource(dbo + "Attack"));
            model.add(myModel.getResource(schemaPrefix + "Governorate"), RDFS.subClassOf, dboModel.getResource(dbo + "Province"));
            model.add(myModel.getResource(schemaPrefix + "SourceMedia"), RDFS.subClassOf, dboModel.getResource(dbo + "Media"));
            model.add(myModel.getResource(schemaPrefix + "Conflict"), myModel.getProperty(schemaPrefix + "occur"), myModel.getResource(schemaPrefix + "ConflictCountry"));
            model.add(myModel.getResource(schemaPrefix + "ConflictCountry"), myModel.getProperty(schemaPrefix + "territorialDivision"), myModel.getResource(schemaPrefix + "ConflictCountry"));
            model.add(myModel.getResource(schemaPrefix + "Victim"), myModel.getProperty(schemaPrefix + "livedIn"), myModel.getResource(schemaPrefix + "Governorate"));
            model.add(myModel.getResource(schemaPrefix + "Victim"), myModel.getProperty(schemaPrefix + "registeredIn"), myModel.getResource(schemaPrefix + "Decease"));
            model.add(myModel.getResource(schemaPrefix + "Victim"), myModel.getProperty(schemaPrefix + "registeredIn"), myModel.getResource(schemaPrefix + "Detention"));
            model.add(myModel.getResource(schemaPrefix + "Victim"), myModel.getProperty(schemaPrefix + "registeredIn"), myModel.getResource(schemaPrefix + "Disappearance"));
            model.add(myModel.getResource(schemaPrefix + "ArmedGroup"), myModel.getProperty(schemaPrefix + "intervenes"), myModel.getResource(schemaPrefix + "Conflict"));
            model.add(myModel.getResource(schemaPrefix + "Assault"), myModel.getProperty(schemaPrefix + "startedBy"), myModel.getResource(schemaPrefix + "ArmedGroup"));
            model.add(myModel.getResource(schemaPrefix + "Assault") , myModel.getProperty(schemaPrefix + "befall"), myModel.getResource(schemaPrefix + "Governorate"));
            model.add(myModel.getResource(schemaPrefix + "Assault"), myModel.getProperty(schemaPrefix + "target"), myModel.getResource(schemaPrefix + "ArmedGroup"));
            model.add(myModel.getResource(schemaPrefix + "Assault"), myModel.getProperty(schemaPrefix + "reportedBy"), myModel.getResource(schemaPrefix + "Source"));
            model.add(myModel.getResource(schemaPrefix + "Source"), RDF.type, myModel.getResource(schemaPrefix + "SourceMedia"));

            }
            var = true;
        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            try {
                if (br != null) {
                    br.close();
                }
            } catch (IOException ex) {
                ex.printStackTrace();
            }
        }

        // list the statements in the Model
        StmtIterator iter = model.listStatements();
        // print out the predicate, subject and object of each statement
        while (iter.hasNext()) {
            Statement stmt = iter.nextStatement();  // get next statement
            Resource subject = stmt.getSubject();     // get the subject
            Property predicate = stmt.getPredicate();   // get the predicate
            RDFNode object = stmt.getObject();      // get the object

            System.out.print(subject.toString());
            System.out.print(" " + predicate.toString() + " ");
            if (object instanceof Resource) {
                System.out.print(object.toString());
            } else {
                // object is a literal
                System.out.print(" \"" + object.toString() + "\"");
            }

            System.out.println(" .");
        }

        // now write the model in XML form to a file
        System.out.println("MODELO RDF SIRIA------");
        model.write(System.out, "N-TRIPLE");

        // Save to a file
        RDFWriter writer = model.getWriter("N-TRIPLE"); //RDF/XML
        writer.write(model, os, "");

        //Cerrar modelos
        dboModel.close();
        model.close();
    }

}
