<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	
  <xsl:output method="html"
		indent="yes"
		encoding="ISO-8859-1"
	/>

	<xsl:template match="previsions">
  
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Météo pour sortir en vélo</title>
      </head>
      <body>
      <h1>Liste des données météo</h1>
        <table border="1">
          <tr>
            <th>Heure</th>
            <th>Temperature</th>
              <th>Pluie</th>
          </tr>
          <xsl:apply-templates select="echeance"/>
        </table>

	    </body>
    </html>

	</xsl:template>
  
	<xsl:template match="echeance">


    <tr>
      <td>
        <xsl:value-of select="@timestamp"/>
      </td>
      <td>
        <xsl:value-of select="format-number(temperature/level[@val = 'sol'] - 273.15, '0.0')"/>
	    </td>
        <td>
            <xsl:value-of select="pluie"/>
        </td>
    </tr>

  </xsl:template>

</xsl:stylesheet>