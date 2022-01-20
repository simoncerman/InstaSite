SELECT parttable.PartNames FROM partonsite
INNER JOIN sites ON sites.id=partonsite.SiteID
INNER JOIN parttable ON parttable.id=partonsite.PartID