<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

    <xsl:output method="html"
                indent="yes"
                encoding="ISO-8859-1"
    />

    <xsl:template match="/carto/markers">

        <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
                <title>Météo pour sortir en vélo</title>
            </head>
            <body>

                    <xsl:apply-templates select="marker"/>





            </body>
        </html>

    </xsl:template>

    <xsl:template match="marker">
        <!-- <xsl:variable name="number" select="@number" />
         <xsl:variable name="disp" select="document(concat('http://www.velostanlib.fr/service/stationdetails/nancy/', $number))" />-->


        <script type="text/javascript">
            var marker = L.marker([<xsl:value-of select="@lat"/>, <xsl:value-of select="@lng"/>], {title: "<xsl:value-of select="@name"/>" }).addTo(mymap);
            <!-- <xsl:apply-templates select="$disp/station/total"/>-->

         </script>



     </xsl:template>
    <!--<xsl:template match="station/total">
       <script type="text/javascript">
           var popup = L.popup();

           function onMapClick(e) {
           popup
           .setLatLng(e.latlng)
           .setContent(<xsl:value-of select="total"/>)
           .openOn(mymap);
           }

           mymap.on('click', onMapClick);
       </script>

   </xsl:template>-->

</xsl:stylesheet>