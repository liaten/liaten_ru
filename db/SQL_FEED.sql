set @row_number = 0;
set @recsPerPage = 6;
set @page = 2;
SELECT
    author, title, cover, theme, description, date
 FROM
 	book
 where (@row_number:=@row_number+1) BETWEEN 1+(@recsPerPage)*(@page-1) AND @recsPerPage*(@page)
 order by
 	date asc