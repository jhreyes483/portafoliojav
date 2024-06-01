<?php

/*
 Adapted from Hyphenator 1.0.2
  http://code.google.com/p/hyphenator/

   Retrieved from http://extensions.services.openoffice.org/project/french-dictionary-reform1990
  License: LGPL
*/

$patterns = "'a1b2r 'a1g2n 'a1mi 'a1na 'a1po 'a2g3nat 'a4 'ab1r\xc3\xa9 'ab3r\xc3\xa9a 'ae3s4c2h 'ag1na 'ami1no 'amino1a2c 'an1ti 'ana3s4t2r 'anti1a2 'anti1e2 'anti1s2 'anti1\xc3\xa92 'anti2en1ne 'apo2s3ta 'ar1ge 'ar1pe 'ar3gent_ 'ar3pent_ 'as2ta 'e1n1a2 'e1n1o2 'e4 'eu2r1a2 'i1g2n 'i1n1a2 'i1n1e2 'i1n1i2 'i1n1o2 'i1n1u2 'i1n1\xc3\xa92 'i2g3ni 'i2g3n\xc3\xa9 'i2g4no 'i4 'in1s2tab 'in1te 'in2a3nit 'in2augur 'in2effab 'in2ept 'in2er 'in2exo1ra 'in2i3mi1ti 'in2i3q 'in2i3t 'in2o3cul 'in2ond 'in2u3l 'in2uit 'in2\xc3\xa93luc1ta 'in2\xc3\xa93nar1ra 'ina1ni 'inau1gu 'inef1fa 'ini1mi 'ino1cu 'ins1ta 'inte1ra2 'inte1re2 'inte1ri2 'inte1ro2 'inte1ru2 'inte1r\xc3\xa92 'inte4r3 'inters2 'in\xc3\xa91lu 'in\xc3\xa91na 'o1vi 'o4 'on1gu 'on3guent_ 'oua1ou 'ovi1s2c 'u4 'y4 '\xc3\xa24 '\xc3\xa84 '\xc3\xa94 '\xc3\xaa4 '\xc3\xae4 '\xc3\xb44 '\xc3\xbb4 _1ba _1bi _1c2h4 _1ci _1co _1cu _1da _1di _1do _1dy _1d\xc3\xa9 _1d\xc3\xa93s2o3d\xc3\xa9 _1ge _1k2h4 _1la _1ma _1mi _1mo _1m\xc3\xa9 _1no _1p2h4 _1p2l _1p2r _1p2sy1c2h _1pa _1pe _1po _1pu _1p\xc3\xa9 _1re _1r\xc3\xa9 _1s2c2h4 _1s2h4 _1sa _1se _1so _1su _1sy _1t2h4 _1t2r _1ta _a1b2r _a1g2n _a1mi _a1na _a1po _a2g3nat _a4 _ab1r\xc3\xa9 _ab3r\xc3\xa9a _ae3s4c2h _ag1na _ami1no _amino1a2c _an1ti _ana3s4t2r _anti1a2 _anti1e2 _anti1s2 _anti1\xc3\xa92 _anti2en1ne _apo2s3ta _ar1de _ar1ge _ar1pe _ar3dent_ _ar3gent_ _ar3pent_ _as2ta _bai1se _bai2se3main _baise1ma _bi1a2c _bi1a2t _bi1au _bi1u2 _bi2s1a2 _bio1a2 _c2h\xc3\xa8 _ch\xc3\xa81v2r _ch\xc3\xa82vre3feuil1le _ch\xc3\xa8v1re _ch\xc3\xa8vre1fe _ch\xc3\xa8vrefeuil2l _ci1sa _ci2s1alp _co1o2 _co2o3lie _com1me _com3ment_ _con1t2r _con4 _cons4 _cont1re _cont1re3ma\xc3\xaet1re _contre1ma _contre1s2c _contrema\xc3\xae1t2r _coo1li _cul4 _da1c2r _dac1ry _dacryo1a2 _di1a2cid _di1a2c\xc3\xa9 _di1a2mi _di1a2tom _di1ald _di1e2n _di2s3h _dia1ci _dia1to _do1le _do3lent_ _dy2s1a2 _dy2s1i2 _dy2s1o2 _dy2s1u2 _dy2s3 _d\xc3\xa91a2 _d\xc3\xa91io _d\xc3\xa91o2 _d\xc3\xa91sa _d\xc3\xa91se _d\xc3\xa91so _d\xc3\xa91su _d\xc3\xa92s _d\xc3\xa92s1i2 _d\xc3\xa92s1u2n _d\xc3\xa92s1\xc2\xbd _d\xc3\xa92s1\xc3\xa92 _d\xc3\xa93s2a3c2r _d\xc3\xa93s2a3tell _d\xc3\xa93s2as1t2r _d\xc3\xa93s2c _d\xc3\xa93s2ensib _d\xc3\xa93s2ert _d\xc3\xa93s2exu _d\xc3\xa93s2i3d _d\xc3\xa93s2i3g2n _d\xc3\xa93s2i3li _d\xc3\xa93s2i3nen _d\xc3\xa93s2i3r _d\xc3\xa93s2in1vo _d\xc3\xa93s2ist _d\xc3\xa93s2o3l _d\xc3\xa93s2o3pil _d\xc3\xa93s2orm _d\xc3\xa93s2orp _d\xc3\xa93s2ou1f2r _d\xc3\xa93s2p _d\xc3\xa93s2t _d\xc3\xa93s2\xc3\xa93g2r _d\xc3\xa9s2a3m _d\xc3\xa9sa1te _d\xc3\xa9sen1si _d\xc3\xa9si1ne _d\xc3\xa9so1pi _e1n1a2 _e1n1o2 _e4 _eu2r1a2 _gem1me _gem2ment_ _i1g2n _i1n1a2 _i1n1e2 _i1n1i2 _i1n1o2 _i1n1u2 _i1n1\xc3\xa92 _i2g3ni _i2g3n\xc3\xa9 _i2g4no _i4 _in1s2tab _in1te _in2a3nit _in2augur _in2effab _in2ept _in2er _in2exo1ra _in2i3mi1ti _in2i3q _in2i3t _in2o3cul _in2ond _in2u3l _in2uit _in2\xc3\xa93luc1ta _in2\xc3\xa93nar1ra _ina1ni _inau1gu _inef1fa _ini1mi _ino1cu _ins1ta _inte1ra2 _inte1re2 _inte1ri2 _inte1ro2 _inte1ru2 _inte1r\xc3\xa92 _inte4r3 _inters2 _in\xc3\xa91lu _in\xc3\xa91na _la1te _la3tent_ _ma1c2r _ma1g2n _ma1la _ma1le _ma1li _ma1lo _ma2c3k _ma2g3nici1de _ma2g3nificat _ma2g3num _ma2l1a2d1ro _ma2l1a2dres _ma2l1a2v _ma2l1ai1s\xc3\xa9 _ma2l1ap _ma2l1en _ma2l1int _ma2l1o2d _ma2l1oc _ma2r1x _mac1ro _macro1s2c _mag1ni _mag1nu _magni1ci _magni1fi _magnifi1ca _mala1d2r _malad1re _mil1li _mil3l _milli1am _mo1no _mono1a2 _mono1e2 _mono1i2 _mono1o2 _mono1s2 _mono1u2 _mono1\xc3\xa92 _mono1\xc3\xaf2d\xc3\xa9 _m\xc3\xa91go _m\xc3\xa91se _m\xc3\xa91su _m\xc3\xa91ta _m\xc3\xa91ta1s2ta _m\xc3\xa92g1oh _m\xc3\xa92s1es _m\xc3\xa92s1i _m\xc3\xa92s1u2s _m\xc3\xa92sa _m\xc3\xa93san _no1no _no2n1obs _o1vi _o4 _on1gu _on3guent_ _oua1ou _ovi1s2c _p1ha _p1lu _p1ro _p1r\xc3\xa9 _p1sy _pa1na _pa1ni _pa1no _pa1r2h _pa1ra _pa1re _pa1te _pa2n1a2f _pa2n1a2m\xc3\xa9 _pa2n1a2ra _pa2n1is _pa2n1o2p2h _pa2n1opt _pa2r1a2c2he _pa2r1a2c2h\xc3\xa8 _pa2r3h\xc3\xa9 _pa3rent_ _pa3tent_ _para1c2h _para1s2 _pe1r1a2 _pe1r1e2 _pe1r1i2 _pe1r1o2 _pe1r1u2 _pe1r1\xc3\xa92 _pe4r _pen2ta _pha1la _phalan3s2t _plu1ri _pluri1a _pon1te _pon2tet _pos1ti _pos2t1in _pos2t1o2 _pos2t3h _pos2t3r _post1s2 _pro1g2n _pro1s2c\xc3\xa9 _pro1\xc3\xa92 _pro2g3na1t2h _prog1na _prou3d2h _pr\xc3\xa91a2 _pr\xc3\xa91e2 _pr\xc3\xa91i2 _pr\xc3\xa91o2 _pr\xc3\xa91s2 _pr\xc3\xa91u2 _pr\xc3\xa91\xc3\xa92 _pr\xc3\xa92a3la _pr\xc3\xa92au _psyc2ho _psycho1a2n _pud1d2l _p\xc3\xa91ri _p\xc3\xa9ri1os _p\xc3\xa9ri1s2 _p\xc3\xa9ri1u2 _p\xc3\xa9ri2s3s _p\xc3\xa9ri2s3ta _re1s2 _re2s3c1ri _re2s3cap _re2s3ci1si _re2s3ci1so _re2s3cou _re2s3pect _re2s3pir _re2s3plend _re2s3pons _re2s3quil _re2s3s _re2s3t _re3s4t2r _re3s4tab _re3s4tag _re3s4tand _re3s4tat _re3s4tim _re3s4tip _re3s4toc _re3s4top _re3s4tu _re3s4ty _re3s4t\xc3\xa9n _re3s4t\xc3\xa9r _re4s5trein _re4s5trict _re4s5trin _res1c2r _res1ca _res1ci _res1co _res1p2l _res1pe _res1pi _res1po _res1q _res1se _res1ta _res1ti _res1to _res1t\xc3\xa9 _res3sent_ _resp1le _rest1re _rest1ri _r\xc3\xa91a2 _r\xc3\xa91e2 _r\xc3\xa91i2 _r\xc3\xa91o2 _r\xc3\xa91t2r _r\xc3\xa91\xc3\xa92 _r\xc3\xa92a3le _r\xc3\xa92a3lis _r\xc3\xa92a3lit _r\xc3\xa92aux _r\xc3\xa92el _r\xc3\xa92er _r\xc3\xa92i3fi _r\xc3\xa92uss _r\xc3\xa92\xc3\xa8r _r\xc3\xa9a1li _r\xc3\xa9t1ro _r\xc3\xa9tro1a2 _r\xc3\xa9u2 _s1ta _s1ti _sar1me _sar3ment_ _ser1me _ser3ment_ _seu2le _sou1ve _sou3vent_ _sta2g3n _stil3l _su1b2l _su1bi _su1bu _su1ri _su1ro _su2b1a2 _su2b1in _su2b1ur _su2b1\xc3\xa92 _su2b3limin _su2b3lin _su2b3lu _su2r1a2 _su2r1e2 _su2r1i2m _su2r1inf _su2r1int _su2r1of _su2r1ox _su2r1\xc3\xa92 _su2r3h _su3b2alt _su3b2\xc3\xa93r _su3r2a3t _su3r2eau _su3r2ell _su3r2et _sub1li _subli1mi _syn1g2n _syn2g3na1t2h _syng1na _t1ri _ta1le _ta3lent_ _tri1a2c _tri1a2n _tri1a2t _tri1o2n _u4 _y4 _\xc3\xa24 _\xc3\xa84 _\xc3\xa91mi _\xc3\xa94 _\xc3\xa9mi1ne _\xc3\xa9mi3nent_ _\xc3\xaa4 _\xc3\xae4 _\xc3\xb44 _\xc3\xbb4 1a2nesth\xc3\xa91si 1alcool 1b2l 1b2r 1ba 1be 1bi 1bo 1bu 1by 1b\xc3\xa2 1b\xc3\xa8 1b\xc3\xa9 1b\xc3\xaa 1b\xc3\xae 1b\xc3\xb4 1b\xc3\xbb 1c2h 1c2k 1c2l 1c2r 1ca 1ce 1ci 1co 1cu 1cy 1c\xc2\xbd0 1c\xc3\xa2 1c\xc3\xa8 1c\xc3\xa9 1c\xc3\xaa 1c\xc3\xae 1c\xc3\xb4 1c\xc3\xbb 1d2'2 1d2r 1da 1de 1di 1do 1du 1dy 1d\xc3\xa2 1d\xc3\xa8 1d\xc3\xa9 1d\xc3\xaa 1d\xc3\xae 1d\xc3\xb4 1d\xc3\xbb 1f2l 1f2r 1fa 1fe 1fi 1fo 1fu 1fy 1f\xc3\xa2 1f\xc3\xa8 1f\xc3\xa9 1f\xc3\xaa 1f\xc3\xae 1f\xc3\xb4 1f\xc3\xbb 1g2ha 1g2he 1g2hi 1g2ho 1g2hy 1g2l 1g2n 1g2r 1ga 1ge 1gi 1go 1gu 1gy 1g\xc3\xa2 1g\xc3\xa8 1g\xc3\xa9 1g\xc3\xaa 1g\xc3\xae 1g\xc3\xb4 1g\xc3\xbb 1ha 1he 1hi 1ho 1hu 1hy 1h\xc3\xa2 1h\xc3\xa8 1h\xc3\xa9 1h\xc3\xaa 1h\xc3\xae 1h\xc3\xb4 1h\xc3\xbb 1informat 1j 1k2h 1k2r 1ka 1ke 1ki 1ko 1ku 1ky 1k\xc3\xa2 1k\xc3\xa8 1k\xc3\xa9 1k\xc3\xaa 1k\xc3\xae 1k\xc3\xb4 1k\xc3\xbb 1la 1le 1li 1lo 1lu 1ly 1l\xc3\xa0 1l\xc3\xa2 1l\xc3\xa8 1l\xc3\xa9 1l\xc3\xaa 1l\xc3\xae 1l\xc3\xb4 1l\xc3\xbb 1m2n\xc3\xa8s 1m2n\xc3\xa91mo 1m2n\xc3\xa91si 1ma 1me 1mi 1mo 1mu 1my 1m\xc2\xbd0 1m\xc3\xa2 1m\xc3\xa8 1m\xc3\xa9 1m\xc3\xaa 1m\xc3\xae 1m\xc3\xb4 1m\xc3\xbb 1na 1ne 1ni 1no 1nu 1ny 1n\xc2\xbd0 1n\xc3\xa2 1n\xc3\xa8 1n\xc3\xa9 1n\xc3\xaa 1n\xc3\xae 1n\xc3\xb4 1n\xc3\xbb 1octet 1p2h 1p2l 1p2neu 1p2n\xc3\xa9 1p2r 1p2sy1c2h 1p2t\xc3\xa8r 1p2t\xc3\xa9r 1pa 1pe 1pi 1po 1pu 1py 1p\xc3\xa2 1p\xc3\xa8 1p\xc3\xa9 1p\xc3\xaa 1p\xc3\xae 1p\xc3\xb4 1p\xc3\xbb 1q 1r2h 1ra 1re 1ri 1ro 1ru 1ry 1r\xc3\xa2 1r\xc3\xa8 1r\xc3\xa9 1r\xc3\xaa 1r\xc3\xae 1r\xc3\xb4 1r\xc3\xbb 1s2c2h 1s2ca1p2h 1s2cl\xc3\xa9r 1s2cop 1s2h 1s2lav 1s2lov 1s2patia 1s2perm 1s2ph\xc3\xa8r 1s2ph\xc3\xa9r 1s2piel 1s2piros 1s2por 1s2tandard 1s2tein 1s2tigm 1s2to1c2k 1s2tomos 1s2tro1p2h 1s2truc1tu 1s2ty1le 1sa 1se 1si 1so 1su 1sy 1s\xc2\xbd0 1s\xc3\xa2 1s\xc3\xa8 1s\xc3\xa9 1s\xc3\xaa 1s\xc3\xae 1s\xc3\xb4 1s\xc3\xbb 1t2h 1t2r 1ta 1te 1ti 1to 1tu 1ty 1t\xc3\xa0 1t\xc3\xa2 1t\xc3\xa8 1t\xc3\xa9 1t\xc3\xaa 1t\xc3\xae 1t\xc3\xb4 1t\xc3\xbb 1v2r 1va 1ve 1vi 1vo 1vu 1vy 1v\xc3\xa2 1v\xc3\xa8 1v\xc3\xa9 1v\xc3\xaa 1v\xc3\xae 1v\xc3\xb4 1v\xc3\xbb 1w2r 1wa 1we 1wi 1wo 1wu 1za 1ze 1zi 1zo 1zu 1zy 1z\xc3\xa8 1z\xc3\xa9 1\xc3\xa7 1\xc3\xa92drie 1\xc3\xa92drique 1\xc3\xa92lec1t2r 1\xc3\xa92l\xc3\xa9ment 1\xc3\xa92nerg 2'2 2b2lent_ 2b2rent_ 2bent_ 2c1k3h 2c2kent_ 2c2lent_ 2c2rent_ 2cent_ 2chb 2chent_ 2chg 2chm 2chn 2chp 2chs 2cht 2chw 2ckb 2ckf 2ckg 2ckp 2cks 2ckt 2d2lent_ 2d2rent_ 2dent_ 2f2lent_ 2f2rent_ 2fent_ 2g2lent_ 2g2nent_ 2g2rent_ 2gent_ 2guent_ 2jent_ 2jk 2kent_ 2lent_ 2nent_ 2p2lent_ 2p2rent_ 2pent_ 2phent_ 2phn 2phs 2pht 2quent_ 2r3heur 2r3hy1d2r 2rent_ 2s2chs 2s3hom 2sent_ 2shent_ 2shm 2shr 2shs 2t2rent_ 2t3heur 2tent_ 2thl 2thm 2thn 2ths 2v2rent_ 2vent_ 2went_ 2xent_ 2zent_ 3d2hal 3d2houd 3ph2ta1l\xc3\xa9 3ph2tis 4b4le_ 4b4les_ 4b4re_ 4b4res_ 4be_ 4bes_ 4c4he_ 4c4hes_ 4c4ke_ 4c4kes_ 4c4le_ 4c4les_ 4c4re_ 4c4res_ 4ce_ 4ces_ 4ch_ 4ch4le_ 4ch4les_ 4ch4re_ 4ch4res_ 4ck_ 4d4re_ 4d4res_ 4de_ 4des_ 4f4le_ 4f4les_ 4f4re_ 4f4res_ 4fe_ 4fes_ 4g4le_ 4g4les_ 4g4ne_ 4g4nes_ 4g4re_ 4g4res_ 4ge_ 4ges_ 4gue_ 4gues_ 4he_ 4hes_ 4je_ 4jes_ 4ke_ 4kes_ 4kh_ 4le_ 4les_ 4me_ 4mes_ 4ne_ 4nes_ 4p4he_ 4p4hes_ 4p4le_ 4p4les_ 4p4re_ 4p4res_ 4pe_ 4pes_ 4ph_ 4ph4le_ 4ph4les_ 4ph4re_ 4ph4res_ 4que_ 4ques_ 4r4he_ 4r4hes_ 4re_ 4res_ 4s4c4he_ 4s4c4hes_ 4s4ch_ 4s4he_ 4s4hes_ 4se_ 4ses_ 4sh_ 4t4he_ 4t4hes_ 4t4re_ 4t4res_ 4te_ 4tes_ 4th_ 4th4re_ 4th4res_ 4v4re_ 4v4res_ 4ve_ 4ves_ 4we_ 4wes_ 4ze_ 4zes_ a1b\xc3\xae a1la a1ma a1ne a1ni a1po a1vi a1\xc3\xa82d1re a2l1al1gi a2s3t1ro ab1se ab2h ab3sent_ abs1ti absti1ne absti3nent_ ab\xc3\xae1me ab\xc3\xae2ment_ ac1ce ac1q ac3cent_ acquies1ce acquies4cent_ ad2h ai1me ai2ment_ al1co amal1ga amalga1me amalga2ment_ an1ti anes1t2h anest1h\xc3\xa9 ani1me ani2ment_ anti1fe antifer1me antifer3ment_ ap1pa apo2s3t2r appa1re appa3rent_ ar1c ar1c2h ar1me ar1mi ar2ment_ arc2hi archi1\xc3\xa92pis archi\xc3\xa91pi armil5l as1me as1t2r as2ment_ au1me au2ment_ avil4l a\xc3\xa81d2r b1le b1re b1ru bou1me bou1ti bou2ment_ boutil3l bru1me bru2ment_ c1ci c1ke c1la c1le c1re c2ha c2he c2hi c2ho c2hu c2hy c2h\xc3\xa2 c2h\xc3\xa8 c2h\xc3\xa9 c2h\xc3\xaa c2h\xc3\xae c2h\xc3\xb4 c2h\xc3\xbb ca1pi ca1r\xc3\xaa ca3ou3t2 capil3l car\xc3\xaa1me car\xc3\xaa2ment_ cci1de cci3dent_ ch1le ch1lo ch1re ch1ro ch2l ch2r che1vi chevil4l chien1de chien3dent_ chlo1ra chlo1r\xc3\xa9 chlo2r3a2c chlo2r3\xc3\xa92t chro1me chro2ment_ cil3l cla1me cla2ment_ co1a2d co1ac1q co1acc co1ap co1ar co1assoc co1assur co1au co1ax co1ef co1en co1ex co1g2n co1nu co1\xc3\xa92 co2g3ni1ti co2nurb coas1so coas1su cog1ni com1p\xc3\xa9 comp\xc3\xa91te comp\xc3\xa93tent_ con1fi con1ni con1ti confi1de confi3dent_ conni1ve conni3vent_ conti1ne conti3nent_ contin1ge contin3gent_ cor1pu corpu1le corpu3lent_ cur1re cur3rent_ cy1ri cyril3l d1d2h d1ha d1ho d1le d1re d1s2 da1me da2ment_ di1li di2s3cop dia1p2h diaph1ra diaph2r diaphrag1me diaphrag2ment_ dili1ge dili3gent_ dis1co dis1si dis1ti dissi1de dissi3dent_ distil3l d\xc3\xa91ca d\xc3\xa91t2r d\xc3\xa9ca1de d\xc3\xa9ca3dent_ d\xc3\xa9t1ri d\xc3\xa9tri1me d\xc3\xa9tri3ment_ e1ni e2n1i2v2r e2s3c2h e2s3cop en1t2r ent1re entre1ge entre3gent_ er1me er2ment_ es1ce es1co es1ti es3cent_ esti1me esti2ment_ eu1s2tat eus1ta ex1t2r ext1ra1 extra2c extra2i f1la f1le f1re f1ri f1s2 fa1me fa2ment_ fi1c2h fic2hu fichu1me fichu3ment_ fir1me fir2ment_ flam1me flam2ment_ fri1ti fritil3l fu1me fu2ment_ f\xc3\xa91cu f\xc3\xa9cu1le f\xc3\xa9cu3lent_ g1le g1ne g1ra g1re g1s2 gil3l gram1me gram2ment_ gran1di grandi1lo grandilo1q grandilo3quent_ hil3l hu1me hu2ment_ hy1pe hy1po hype1ra2 hype1re2 hype1ri2 hype1ro2 hype1ru2 hype1r\xc3\xa92 hype4r1 hypers2 hypo1a2 hypo1e2 hypo1i2 hypo1o2 hypo1s2 hypo1u2 hypo1\xc3\xa92 h\xc3\xa91mi h\xc3\xa91mo h\xc3\xa9mi1\xc3\xa9 h\xc3\xa9mo1p2t i1al1gi i1arth2r i1b2r i1oxy i1s2c2h i1s2tat i1va i1\xc3\xa82d1re i2s3c2h\xc3\xa9 i2s3chia i2s3chio iar1t2h ib1ri ibril3l il2l im1ma im1mi im1po im1pu imma1ne imma3nent_ immi1ne immi3nent_ immis1ce immis4cent_ impo1te impo3tent_ impu1de impu3dent_ in1ci in1di in1do in1du in1fo in1no in1so in1te in1ti inci1de inci3dent_ indi1ge indi3gent_ indo1le indo3lent_ indul1ge indul3gent_ infor1ma inno1ce inno3cent_ ins1ti inso1le inso3lent_ instil3l intel1li intelli1ge intelli3gent_ inti1me inti2ment_ io1a2ct is1ce is1ta is3cent_ isc2hi iva1le iva3lent_ i\xc3\xa81d2r ja1ce ja3cent_ l1li l1lu l1me l1s2t l2ment_ l3lion la1w2r la2w3re lil3l llu1me llu2ment_ m1n\xc3\xa8 m1n\xc3\xa9 m1s2 mi1me mi2ment_ mil1le mil3l mil4let mit1te mit3tent_ mo1no mon1t2r mon2t3r\xc3\xa9al mono1va monova1le monova3lent_ mont1r\xc3\xa9 moye1n\xc3\xa2 moye2n1\xc3\xa22g mu1ni muni1fi munifi1ce munifi3cent_ m\xc3\xa91co m\xc3\xa9con1te m\xc3\xa9con3tent_ n1sa n1x n3s2at_ n3s2ats_ nu1t2r nut1ri nutri1me nutri3ment_ o1b2l o1d2l o1g2n o1io1ni o1pu o1s2tas o1s2tat o1s2tim o1s2tom o1s2tra1tu o1s2trad o1s2triction o1s2t\xc3\xa91ro o1\xc3\xa82d1re o2b3long o2g3no1si o2g3nomo1ni ob1lo oc1te og1no ogno1mo om1bu om1me om1ni om2ment_ ombud2s3 omni1po omni1s2 omnipo1te omnipo3tent_ opu1le opu3lent_ or1me or2ment_ os1t2r os1ta os1ti os1to os1t\xc3\xa9 ost1ra ost1ri ostric1ti oxy1a2 o\xc3\xa81d2r p1he p1ho p1le p1lu p1ne p1re p1ri p1ro p1ru p1r\xc3\xa9 p1sy p1t\xc3\xa8 p1t\xc3\xa9 pa1l\xc3\xa9 pa1pi pal\xc3\xa9o1\xc3\xa92 papil1lo papil2l papil3la papil3le papil3li papil3lom pe1r3h per1ma per1ti perma1ne perma3nent_ perti1ne perti3nent_ ph1le ph1re ph1ta ph1ti ph2l ph2r pho1to photo1s2 pi1ri piril3l plu1me plu2ment_ po1ast1re po1ly poas1t2r poly1a2 poly1e2 poly1i2 poly1o2 poly1s2 poly1u2 poly1va poly1\xc3\xa82 poly1\xc3\xa92 polyva1le polyva3lent_ pri1va privat1do privatdo1ce privatdo1ze privatdo3cent_ privatdo3zent_ pro2s3tat pros1ta pro\xc3\xa91mi pro\xc3\xa9mi1ne pro\xc3\xa9mi3nent_ pru1de pru3dent_ pr\xc3\xa91se pr\xc3\xa93sent_ pr\xc3\xa9\xc3\xa91mi pr\xc3\xa9\xc3\xa9mi1ne pr\xc3\xa9\xc3\xa9mi3nent_ pu1g2n pu1pi pu1si pu2g3nab1le pu2g3nac pug1na pugna1b2l pupil3l pusil3l p\xc3\xa91nu p\xc3\xa91r2\xc3\xa92q p\xc3\xa91r\xc3\xa9 p\xc3\xa92nul qua1me qua2ment_ r1ci r1he r1hy r1mi ra1di ra1me ra2ment_ radio1a2 rai1me rai3ment_ rcil4l re1le re1li re1pe re3lent_ re3pent_ reli1me reli2ment_ ri1me ri2ment_ rin1ge rin3gent_ rmil4l ru1le ru3lent_ ry1t2h ry2thm ryth1me ryth2ment_ r\xc3\xa91ge r\xc3\xa91ma r\xc3\xa91su r\xc3\xa91ti r\xc3\xa93gent_ r\xc3\xa9ma1ne r\xc3\xa9ma3nent_ r\xc3\xa9sur1ge r\xc3\xa9sur3gent_ r\xc3\xa9ti1ce r\xc3\xa9ti3cent_ s1c2l s1ca s1co s1he s1ho s1la s1lo s1p2h s1pa s1pe s1pi s1po s1t2r s1ta s1te s1ti s1to s1ty s1t\xc3\xa9 sc1l\xc3\xa9 sc2he se1mi semil4l ser1ge ser1pe ser3gent_ ser3pent_ ses1q sesqui1a2 sla1lo slalo1me slalo2ment_ sp1h\xc3\xa8 sp1h\xc3\xa9 spa1ti spi1ro spo1ru sporu1le sporu4lent_ st1ro st1ru stan1da sto1mo st\xc3\xa91r\xc3\xa9 st\xc3\xa9r\xc3\xa9o1s2 su1b2l su1me su1pe su1ra su1r\xc3\xa9 su2ment_ su3r2ah sub1li sub1s2 subli1me subli2ment_ suc1cu succu1le succu3lent_ supe1ro2 supe4r1 supers2 sur\xc3\xa91mi sur\xc3\xa9mi1ne sur\xc3\xa9mi3nent_ t1c2h t1he t1ra t1re t1ri t1ru t1t2l ta1c2h ta1me ta2ment_ tac2hy tachy1a2 tan1ge tan3gent_ tc2hi tchin3t2 tem1p\xc3\xa9 temp\xc3\xa91ra temp\xc3\xa9ra1me temp\xc3\xa9ra3ment_ ter1ge ter3gent_ tes1ta testa1me testa3ment_ th1re th1ri th2r ther1mo thermo1s2 thril3l to1me to2ment_ tor1re tor3rent_ tran2s1a2 tran2s1o2 tran2s1u2 tran2s3h tran2s3p tran3s2act tran3s2ats trans1pa transpa1re transpa3rent_ tri1de tri3dent_ tru1cu trucu1le trucu3lent_ tu1me tu2ment_ tung2s3 tur1bu turbu1le turbu3lent_ t\xc3\xa91l\xc3\xa9 t\xc3\xa9l\xc3\xa91e2 t\xc3\xa9l\xc3\xa91i2 t\xc3\xa9l\xc3\xa91o2b t\xc3\xa9l\xc3\xa91o2p t\xc3\xa9l\xc3\xa91s2 u1ci u1ni u1vi u2s3t2r ucil4l ue1vi uevil4l uni1a2x uni1o2v uvil4l v1re va1ci va1ni vacil4l vanil1li vanil2l vanil3lin vanil3lis ve1ni ven1t2r veni1me veni2ment_ vent1ri ventri1po ventripo1te ventripo3tent_ vi1di vidi1me vidi2ment_ vil3l vol1ta vol2t1amp v\xc3\xa91lo v\xc3\xa9lo1s2ki wa2g3n xil3l y1al1gi y1as1t2h y1s2tom ys1to \xc3\xa21me \xc3\xa22ment_ \xc3\xa81me \xc3\xa82ment_ \xc3\xa91ce \xc3\xa91ci \xc3\xa91cu \xc3\xa91d2r \xc3\xa91de \xc3\xa91le \xc3\xa91li \xc3\xa91lo \xc3\xa91l\xc3\xa9 \xc3\xa91mi \xc3\xa91ne \xc3\xa91ni \xc3\xa91pi \xc3\xa91q \xc3\xa91re \xc3\xa93cent_ \xc3\xa93dent_ \xc3\xa93quent_ \xc3\xa93rent_ \xc3\xa9ci1me \xc3\xa9ci2ment_ \xc3\xa9cu1me \xc3\xa9cu2ment_ \xc3\xa9d1ri \xc3\xa9d2hi \xc3\xa9dri1q \xc3\xa9li1me \xc3\xa9li2ment_ \xc3\xa9lo1q \xc3\xa9lo3quent_ \xc3\xa9l\xc3\xa91me \xc3\xa9mil4l \xc3\xa9ni1te \xc3\xa9ni3tent_ \xc3\xa9pi2s3cop \xc3\xa9pi3s4co1pe \xc3\xa9pis1co \xc3\xa9qui1po \xc3\xa9qui1va \xc3\xa9quipo1te \xc3\xa9quipo3tent_ \xc3\xa9quiva1le \xc3\xa9quiva4lent_ \xc3\xb41me \xc3\xb42ment_";
