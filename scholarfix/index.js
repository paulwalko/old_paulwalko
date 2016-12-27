self = require('sdk/self');
var pageMod = require('sdk/page-mod');

pageMod.PageMod({
	include: "https://scholar.vt.edu/*",
	contentScriptFile: [self.data.url("./jquery.js"), self.data.url("./changeScholar.js")]
});
